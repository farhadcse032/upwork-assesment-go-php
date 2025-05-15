<!DOCTYPE html>
<html>
<head>
    <title>Employee Data Table</title>
</head>
<body>
    <h2>Employee Data Table</h2>
    <form method="GET">
    <input type="text" name="queries" placeholder="Filter name, email, role or tech..." value="<?= htmlspecialchars($_GET['queries'] ?? '') ?>">
        <button type="submit">Filter</button>
    </form>
    <br>
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Position</th>
            <th>Tech Stack</th>
        </tr>
        <?php foreach ($data as $row): ?>
            <tr>
                <td><?= htmlspecialchars($row['id']) ?></td>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars($row['designation']) ?></td>
                <td><?= htmlspecialchars(implode(', ', $row['stack'])) ?></td>
            </tr>
        <?php endforeach; ?>
        <?php if (empty($data)): ?>
            <tr><td colspan="3">No data found.</td></tr>
        <?php endif; ?>
    </table>
</body>
</html>
