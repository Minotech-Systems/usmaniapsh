<?php

if (!empty($user_id) && empty($book_id) && empty($chapter_id) && empty($lesson_id)) {
    include '_user_overall_info.php';
} elseif (!empty($user_id) && !empty($book_id) && empty($chapter_id) && empty($lesson_id)) {
    include '_user_book_info.php';
} elseif (!empty($user_id) && !empty($book_id) && !empty($chapter_id) && empty($lesson_id)) {
    include '_user_chapter_info.php';
} else {
    include '_user_lesson_info.php';
}
?>