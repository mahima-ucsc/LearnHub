<?php

declare(strict_types=1);


function  dd(mixed $value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
    die();
}

function e(mixed $value): string
{
    return htmlspecialchars((string) $value);
}

function redirectTo(string $path)
{
    header("Location: {$path}");
    http_response_code(302);
    exit;
}

function formatDate($date, $format = 'F j, Y, g:i a')
{
    $dateTime = new DateTime($date);
    return $dateTime->format($format);
}


/**
 * Generate pagination data for displaying items in pages
 *
 * @param int $totalItems Total number of items to paginate
 * @param int $currentPage Current page number (defaults to 1)
 * @param int $itemsPerPage Number of items per page (defaults to 10)
 * @param array $queryParams Additional query parameters to preserve in pagination links
 * @return array Pagination data including page links, offsets, and navigation links
 */
function generatePagination(int $totalItems, int $currentPage = 1, int $itemsPerPage = 10, array $queryParams = []): array
{
    // Ensure current page is valid
    $currentPage = max(1, $currentPage);

    // Calculate offset for database query
    $offset = ($currentPage - 1) * $itemsPerPage;

    // Calculate last page
    $lastPage = ceil($totalItems / $itemsPerPage);

    // Generate array of page numbers
    $pages = $lastPage ? range(1, $lastPage) : [];

    // Create page links with all query parameters
    $pageLinks = array_map(
        function ($pageNum) use ($queryParams) {
            return http_build_query(array_merge(
                ['p' => $pageNum],
                $queryParams
            ));
        },
        $pages
    );

    // Create previous and next page query strings
    $previousPageQuery = http_build_query(array_merge(
        ['p' => max(1, $currentPage - 1)],
        $queryParams
    ));

    $nextPageQuery = http_build_query(array_merge(
        ['p' => min($lastPage, $currentPage + 1)],
        $queryParams
    ));

    return [
        'currentPage' => $currentPage,
        'itemsPerPage' => $itemsPerPage,
        'totalItems' => $totalItems,
        'offset' => $offset,
        'lastPage' => $lastPage,
        'pages' => $pages,
        'pageLinks' => $pageLinks,
        'previousPageQuery' => $previousPageQuery,
        'nextPageQuery' => $nextPageQuery,
        'hasPreviousPage' => $currentPage > 1,
        'hasNextPage' => $currentPage < $lastPage,
    ];
}

function generateRadomString(int $length)
{
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $index = rand(0, 62);
        $randomString .= $characters[$index];
    }

    return $randomString;
}

function calDateDiff($startDate)
{
    $start = new DateTime($startDate);
    $end = new DateTime();

    $diff = $start->diff($end);

    return [
        'years' => $diff->y,
        'months' => $diff->m,
        'days' => $diff->d
    ];
}
