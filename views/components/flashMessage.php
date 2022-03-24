<?php
function flashMessage()
{
    if (isset($_SESSION['flash_message'])) {
        $message = $_SESSION['flash_message']['message'];
        $type = $_SESSION['flash_message']['type'];

?>

        <div class="flash-container container">
            <div class="alert alert-<?= $type ?> alert-dismissible fade" role="alert">
                <strong></strong><?= $message ?>

            </div>
        </div>
        <script>
        </script>
<?php
    }
    unset($_SESSION['flash_message']);
}
flashMessage();
?>