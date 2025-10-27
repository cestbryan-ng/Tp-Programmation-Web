<?php
// generate-partials.php
// Usage (CLI): php tools/generate-partials.php
// Crée htm/partials/{slug}.html contenant uniquement l'intérieur de la balise <body>

$root = __DIR__ . '/..';
$htm_dir = realpath( $root . '/htm' );
if ( ! $htm_dir || ! is_dir( $htm_dir ) ) {
    echo "htm/ directory not found\n";
    exit(1);
}

$partials_dir = $htm_dir . '/partials';
if ( ! is_dir( $partials_dir ) ) {
    mkdir( $partials_dir, 0755, true );
}

$files = glob( $htm_dir . '/*.html' );
foreach ( $files as $file ) {
    $basename = basename( $file );
    $slug = pathinfo( $basename, PATHINFO_FILENAME );
    $html = file_get_contents( $file );
    if ( $html === false ) {
        echo "failed to read $file\n";
        continue;
    }

    // Try to extract <body> content using DOMDocument
    libxml_use_internal_errors(true);
    $doc = new DOMDocument();
    // Force UTF-8
    $loaded = $doc->loadHTML('<?xml encoding="utf-8" ?>' . $html);
    $body = null;
    if ( $loaded ) {
        $bodies = $doc->getElementsByTagName('body');
        if ( $bodies->length > 0 ) {
            $body = $bodies->item(0);
            $inner = '';
            foreach ( $body->childNodes as $child ) {
                $inner .= $doc->saveHTML( $child );
            }
        }
    }

    if ( empty( $inner ) ) {
        // Fallback: use entire file
        $inner = $html;
    }

    $out = $partials_dir . '/' . $slug . '.html';
    file_put_contents( $out, $inner );
    echo "Wrote $out\n";
}

echo "Done. Partials are in htm/partials/\n";
