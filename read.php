<?php
include 'functions.php';
// Connect to MySQL database
$pdo = pdo_connect_mysql();
// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = isset($_GET['records-per-page']) && in_array($_GET['records-per-page'], [5, 10, 20, 50]) ? (int)$_GET['records-per-page'] : 5;

// Prepare the SQL statement and get records from our contacts table, LIMIT will determine the page
// Get the search term via GET request (URL param: search)
$search = isset($_GET['search']) && !empty($_GET['search']) ? $_GET['search'] : '';

// Prepare the SQL statement and get records from our contacts table, LIMIT will determine the page
if ($search) {
    $stmt = $pdo->prepare('SELECT * FROM contacts WHERE id LIKE :search OR phone LIKE :search OR name LIKE :search OR email LIKE :search OR title LIKE :search OR created LIKE :search ORDER BY id LIMIT :current_page, :record_per_page');
    $stmt->bindValue(':search', '%' . $search . '%');
} else {
    $stmt = $pdo->prepare('SELECT * FROM contacts ORDER BY id LIMIT :current_page, :record_per_page');
}

$stmt->bindValue(':current_page', ($page - 1) * $records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();

// Fetch the records so we can display them in our template.
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get the total number of contacts, this is so we can determine whether there should be a next and previous button
$num_contacts = $pdo->query('SELECT COUNT(*) FROM contacts' . ($search ? ' WHERE id LIKE "%' . $search . '%" OR phone LIKE "%' . $search . '%" OR name LIKE "%' . $search . '%" OR email LIKE "%' . $search . '%" OR title LIKE "%' . $search . '%" OR created LIKE "%' . $search . '%"' : ''))->fetchColumn();
?>

<?= template_header('Read') ?>

<div class="content read">
    <h2>Read Contacts</h2>

    <a href="create.php" class="create-contact">Create Contact</a>

    <!-- Search form -->
    <div class="search-form">
        <form action="read.php" method="get">
            <input type="text" name="search" placeholder="Search..." value="<?= isset($_GET['search']) ? htmlentities($_GET['search'], ENT_QUOTES) : '' ?>">
            <input type="submit" value="Search">
        </form>
    </div>



    <table>
        <!-- Records per page dropdown -->
<div class="records-per-page">
    <form action="read.php" method="get">
        <label for="records-per-page">Records per page:</label>
        <select name="records-per-page" id="records-per-page" onchange="this.form.submit()">
            <option value="5" <?= $records_per_page == 5 ? 'selected' : '' ?>>5</option>
            <option value="10" <?= $records_per_page == 10 ? 'selected' : '' ?>>10</option>
            <option value="20" <?= $records_per_page == 20 ? 'selected' : '' ?>>20</option>
            <option value="50" <?= $records_per_page == 50 ? 'selected' : '' ?>>50</option>
        </select>
    </form>
</div>
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Phone</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Title</th>
                <th scope="col">Created</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contacts as $contact) : ?>
                <tr>
                    <td data-label="#"><?= $contact['id'] ?></td>
                    <td data-label="Phone: "><?= $contact['phone'] ?></td>
                    <td data-label="Name: "><?= $contact['name'] ?></td>
                    <td data-label="Email: "><?= $contact['email'] ?></td>
                    <td data-label="Title: "><?= $contact['title'] ?></td>
                    <td data-label="Created: "><?= $contact['created'] ?></td>
                    <td class="actions">
                        <a href="update.php?id=<?= $contact['id'] ?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                        <a href="delete.php?id=<?= $contact['id'] ?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="pagination">
        <?php if ($page > 1) : ?>
            <a href="read.php?page=<?= $page - 1 ?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
        <?php endif; ?>
        <?php if ($page * $records_per_page < $num_contacts) : ?>
            <a href="read.php?page=<?= $page + 1 ?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
        <?php endif; ?>
    </div>
</div>

<?= template_footer() ?>