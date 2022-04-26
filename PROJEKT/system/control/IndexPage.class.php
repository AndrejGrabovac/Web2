<?php
class IndexPage extends AbstractPage {
    function code() {
        $this->v['test'] = 5 + 5;

        // primjer SQL upita
        $sql = "SELECT * FROM users";
        $result = AppCore::getDB()->sendQuery($sql);
        $users = [];
        while ($row = AppCore::getDB()->fetchArray($result)) {
            $users[] = $row;
        }
        $this->v['users'] = $users;

        $datetime = time();
        print $datetime . ' = ' . date('d.m.Y H:i:s', $datetime);
    }
}
?>