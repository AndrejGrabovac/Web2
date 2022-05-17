<?php
class IndexPage extends AbstractPage
{
    function code()
    {
        $ch = curl_init('https://openexchangerates.org/api/currencies.json');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $json = curl_exec($ch);
        curl_close($ch);

        $currencies = json_decode($json, true);
        

        //CHECK EXISTING DATA
        $sql = "SELECT * FROM currencies ";
        $result = AppCore::getDB()->sendQuery($sql);
        $existingCurrencies = [];
        while ($row = AppCore::getDB()->fetchArray($result)) {
            //$currencies[$row['ID']] = $row;
            unset($currencies[$row['3letter']]);
        }

        // prepare insert
        $sql = [];
        foreach ($currencies as $ticker => $name) {
            $sql[] = "(
                '".AppCore::getDB()->escapeString($ticker)."',
                '".AppCore::getDB()->escapeString($name)."'
            )";
        }

        // insert
        if (!empty($sql)) {
            $sql = "INSERT INTO currencies (3letter, fullName)
                    VALUES " . implode(',', $sql);
            AppCore::getDB()->sendQuery($sql);
        }






        //$sql = "INSERT INTO currencies ";
        //echo $currencies[''][''];

        /*
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
        */
    }
}
