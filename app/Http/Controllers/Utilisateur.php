<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Token;
use PhpParser\Node\Expr;

use function Pest\Laravel\call;

class Utilisateur extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/connexion",
     *     summary="connexion utilisateur",
     *     tags={"Utilisateur"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             required={"email", "mot_de_passe"},
     *             @OA\Property(property="email", type="string"),
     *             @OA\Property(property="mot_de_passe", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="La connexion a réussie avec succès",
     *         @OA\JsonContent(
     *             @OA\Property(property="id_utilisateur", type="string"),
     *             @OA\Property(property="nom_utilisateur", type="string"),
     *             @OA\Property(property="nom", type="string"),
     *             @OA\Property(property="prenom", type="string"),
     *             @OA\Property(property="token", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=301,
     *         description="Mot de passe incorrect",
     *     ),
     *     @OA\Response(
     *         response=304,
     *         description="Compte inexistant",
     *     )
     * )
     */
    public function connexion(Request $request)
    {
        $data = $request->json()->all();
        $email = $data['email'];
        $mot_de_passe = $data['mot_de_passe'];

        $utilisateur = DB::table('Utilisateur')
            ->select('id_utilisateur', 'nom_utilisateur', 'nom', 'prenom', 'mot_de_passe', 'date_naissance')
            ->where('email', $email)
            ->get();

        if (count($utilisateur) > 0) {
            if ($utilisateur[0]->mot_de_passe === $mot_de_passe) {
                $token = Token::genererToken();
                DB::table('Utilisateur')
                    ->where('email', $email)
                    ->update(['token' => $token]);

                return response()->json([
                    'id_utilisateur' => $utilisateur[0]->id_utilisateur,
                    'nom_utilisateur' => $utilisateur[0]->nom_utilisateur,
                    'nom' => $utilisateur[0]->nom,
                    'prenom' => $utilisateur[0]->prenom,
                    'token' => $token,
                    'date_naissance' => $utilisateur[0]->date_naissance,
                    'email' => $email
                ], 200);
            } else {
                return response()->noContent(301);
            }
        } else {
            return response()->noContent(304);
        }
    }

    /**
     * @OA\Put(
     *     path="/api/deconnexion",
     *     summary="Déconnexion utilisateur",
     *     tags={"Utilisateur"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Déconnexion réussie"
     *     ),
     *     @OA\Response(
     *         response=301,
     *         description="Token invalide ou expiré"
     *     ),
     *     @OA\Response(
     *         response=304,
     *         description="Utilisateur introuvable"
     *     )
     * )
     */
    public function deconnexion(Request $request)
    {
        $authHeader = $request->header('Authorization');

        if (!$authHeader) {
            return response()->noContent(301);
        }

        $token = str_replace('Bearer ', '', $authHeader);

        $modif = DB::table('Utilisateur')
            ->where('token', $token)
            ->update([
                'token' => null
            ]);

        if ($modif) {
            return response()->noContent(200);
        }

        return response()->noContent(304);
    }

    /**
     * @OA\Post(
     *     path="/api/inscription",
     *     summary="inscription utilisateur",
     *     tags={"Utilisateur"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             required={"nom_utilisateur", "email", "mot_de_passe"},
     *             @OA\Property(property="nom_utilisateur", type="string"),
     *             @OA\Property(property="email", type="string"),
     *             @OA\Property(property="mot_de_passe", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="L'inscription a réussie avec succès",
     *     ),
     *     @OA\Response(
     *         response=301,
     *         description="Nom d'utilisateur existant",
     *     ),
     *     @OA\Response(
     *         response=304,
     *         description="Email déjà utilisée",
     *     )
     * )
     */
    public function inscription(Request $request)
    {
        $data = $request->json()->all();

        try {
            Conversion::convertir($data);
            DB::table('Utilisateur')
                ->insert($data);
            return response()->noContent(200);
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            if (str_contains($errorMessage, 'Utilisateur.nom_utilisateur')) {
                return response()->json([
                    'message' => $errorMessage
                ], 301);
            } elseif (str_contains($errorMessage, 'Utilisateur.email')) {
                return response()->json([
                    'message' => $errorMessage
                ], 304);
            }
        }
    }

    /**
     * @OA\Put(
     *     path="/api/modifier_infos",
     *     summary="Modifier les informations de l'utilisateur",
     *     tags={"Utilisateur"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             required={"nom", "prenom", "email", "date_naissance"},
     *             @OA\Property(property="nom", type="string"),
     *             @OA\Property(property="prenom", type="string"),
     *             @OA\Property(property="email", type="string"),
     *             @OA\Property(property="date_naissance", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Informations de l'utilisateur modifiées avec succès"
     *     ),
     *     @OA\Response(
     *         response=301,
     *         description="Token invalide ou expiré"
     *     ),
     *     @OA\Response(
     *         response=304,
     *         description="Utilisateur introuvable"
     *     )
     * )
     */
    public function modifier_infos(Request $request)
    {
        $data = $request->json()->all();
        $authHeader = $request->header('Authorization');
        Conversion::convertir($data);

        if (!$authHeader) {
            return response()->noContent(301);
        }

        $token = str_replace('Bearer ', '', $authHeader);

        $modifs = [];
        $modifs['nom'] = $data['nom'];
        $modifs['prenom'] = $data['prenom'];
        $modifs['date_naissance'] = $data['date_naissance'];
        if (!empty($data['email'])) {
            $modifs['email'] = $data['email'];
        }

        try {
            if (!empty($modifs)) {
                DB::table('Utilisateur')
                    ->where('token', $token)
                    ->update($modifs);
            }
            return response()->noContent(200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 304);
        }
    }

    /**
     * @OA\Put(
     *     path="/api/modifier_mdp",
     *     summary="Modifier le mot de passe de l'utilisateur",
     *     tags={"Utilisateur"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             required={"mot_de_passe"},
     *             @OA\Property(property="mot_de_passe", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Mot de passe de l'utilisateur modifié avec succès"
     *     ),
     *     @OA\Response(
     *         response=301,
     *         description="Token invalide ou expiré"
     *     ),
     *     @OA\Response(
     *         response=304,
     *         description="Utilisateur introuvable"
     *     ),
     *     @OA\Response(
     *         response=307,
     *         description="Mot de passe vide"
     *     )
     * )
     */
    public function modifier_mdp(Request $request)
    {
        $data = $request->json()->all();
        $mot_de_passe = $data["mot_de_passe"];
        $authHeader = $request->header('Authorization');

        if (!$authHeader) {
            return response()->noContent(301);
        }

        if (empty($mot_de_passe)) {
            return response()->noContent(307);
        }

        $token = str_replace('Bearer ', '', $authHeader);

        $modif = DB::table('Utilisateur')
            ->where('token', $token)
            ->update([
                'mot_de_passe' => $mot_de_passe,
                'date_modif_mdp' => date('d-m-Y')
            ]);

        if ($modif) {
            return response()->noContent(200);
        }

        return response()->noContent(304);
    }
}
