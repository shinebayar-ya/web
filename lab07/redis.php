<?php
function fetch_string_from_cache($redis, $key, $expiration, $conn, &$src)
{
    if ($redis->exists($key)) {
        $src = "Redis";
        return unserialize($redis->get($key));
    }
    $data = fetch_table_from_db($conn);
    $serializedData = serialize($data);
    $redis->set($key, $serializedData, $expiration);
    return $data;
}

function set_hash_record($cache, $cache_key, $data, $expiration)
{
    foreach ($data as $i => $row) {
        $hash_key = $cache_key.$row['PetID'];
        $row['order'] = $i;
        // Хэш түлхүүр = Амьтаны нэр + Амьтаны код
        $cache->hMSet($hash_key, $row);
        $cache->expire($hash_key, $expiration);
    }
}

function fetch_record_from_cache($cache, $table, $key, $expiration, $conn, &$src)
{
    $cached_data = [];
    $cache_key = $table . ":" . $key . ":";
    // Бүх мөрийг авахын тулд
    $hash_keys = $cache->keys($cache_key . "*");
    foreach ($hash_keys as $hash_key) {
        $cached_data[] = $cache->hGetAll($hash_key);
    }
    if (empty($cached_data)) {
        if ($key == 'row') {
            $data = fetch_table_from_db($conn);
        } else {
            $data = fetch_record_from_db($conn, $key);
        }

        set_hash_record($cache, $cache_key, $data, $expiration);

        return $data;
    }
    $src = "Redis";

    // DB -аас авсан дарааллаар харуулахын тулд
    usort($cached_data, function ($row_a, $row_b) {
        return $row_a['order'] <=> $row_b['order'];
    });
    return $cached_data;
}
?>