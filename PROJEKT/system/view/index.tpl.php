<html>

<body>
    <h1>Index page</h1>
    Rezultat zbrajanja: <?= $v['test'] ?>

    <table>
        <tr>
            <th>UserID</th>
            <th>Ime</th>
        </tr>
        <?php foreach ($v['users'] as $user) { ?>
            <tr>
                <td><?= $user['userID'] ?></td>
                <td><?= $user['ime'] ?></td>
            </tr>
        <?php } ?>
    </table>
</body>

</html>