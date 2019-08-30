<?php
$connect = mysqli_connect("localhost", "good", "12345", "geekbrains");

$query = mysqli_query($connect, "SELECT * FROM category_links WHERE child_id = parent_id");
$parents = [];
while ($parent = mysqli_fetch_assoc($query)) {
    $parents[$parent['parent_id']] = $parent['level'];
}

$query = "
        SELECT c.id_category, c.category_name, cl.parent_id, cl.child_id, cl.level
        FROM `categories` c
        INNER JOIN `category_links` cl ON (c.id_category = cl.child_id)
";

$result = mysqli_query($connect, $query);
$cats = [];
while ($cat = mysqli_fetch_assoc($result)) {

    if ($cat["level"] == 0) {
        $cats[0][$cat["id_category"]] = $cat;
    }

    if ($parents[$cat["parent_id"]] == ($cat["level"] - 1)) {
        $cats[$cat["parent_id"]][$cat["id_category"]] = $cat;
    }
}

function buildTree($cats, $parent_id)
{
    if (is_array($cats) && isset($cats[$parent_id])) {
        $tree = "<ul>";
        foreach ($cats[$parent_id] as $cat) {
            $tree .= "<li>" . $cat["category_name"];
            $tree .= buildTree($cats, $cat["id_category"]);
            $tree .= "</li>";
        }
        $tree .= "</ul>";
        return $tree;
    }
}

echo buildTree($cats, 0);