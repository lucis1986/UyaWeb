<td id="right_area">

    <table>
        <tr>
            <td><?= mb_strimwidth($row->title, 0, 50, "...", "utf8") ?></td>
        </tr>
        <tr>
            <td><?= $row->body ?></td>
        </tr>
        <tr>
            <td><?= $row->author ?></td>
        </tr>
        <tr>
            <td><?= $row->created ?></td>
        </tr>

    </table>

</td>
