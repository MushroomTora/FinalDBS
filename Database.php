<?php

class Database
{
    const DB_SERVER = 'localhost';
    const DB_USER   = 'root';
    const DB_PASS   = '';
    const DB_NAME   = 'newsportal';

    /**
     * @var false|mysqli
     */
    protected $connection;

    /**
     * Database constructor.
     *
     * @throws Exception
     */
    public function __construct()
    {
        if (is_null($this->connection)) {
            $this->connection = mysqli_connect(self::DB_SERVER, self::DB_USER, self::DB_PASS, self::DB_NAME);
        }

        if (empty($this->connection)) {
            throw new \Exception('Failed to connect to MySQL: ' . mysqli_connect_error());
        }
    }

    /**
     * @param int    $postId
     * @param string $email
     * @param string $name
     * @param string $content
     * @param int    $status
     *
     * @return bool
     */
    public function createComment($postId, $email, $name, $content, $status = 1)
    {
        return (bool) mysqli_query(
            $this->connection,
            'INSERT INTO tblcomments(postId,name,email,comment,status)' .
            " VALUES({$postId}, '{$name}','{$email}','{$content}',{$status})"
        );
    }

    /**
     * @param $postId
     *
     * @return array
     * @throws Exception
     */
    public function getPostComment($postId)
    {
        $query = mysqli_query(
            $this->connection,
            "select * from tblcomments where postId='{$postId}' and status=1"
        );

        if (!$query) {
            throw new \Exception('Query error!');
        }

        return mysqli_fetch_all($query, MYSQLI_ASSOC) ?: [];
    }

    /**
     * @param $postId
     *
     * @return array
     * @throws Exception
     */
    public function getPostDetail($postId)
    {
        $sql = 'SELECT p.*, c.CategoryName, sc.Subcategory ' .
            'FROM tblposts as p ' .
            'LEFT JOIN tblcategory as c on c.id = p.CategoryId ' .
            'LEFT JOIN tblsubcategory as sc on sc.SubCategoryId = p.SubCategoryId ' .
            'WHERE p.id = ' . $postId;
        $query = mysqli_query($this->connection, $sql);

        if (!$query) {
            throw new \Exception('Query error!');
        }

        $posts = mysqli_fetch_array($query, MYSQLI_ASSOC);
        if ($posts) {
            return $posts;
        } else {
            throw new \Exception('Post not found');
        }
    }

    public function getMostPopular()
    {
        $sql = 'SELECT p.*, c.CategoryName, sc.Subcategory ' .
            'FROM tblposts as p ' .
            'LEFT JOIN tblcategory as c on c.id = p.CategoryId ' .
            'LEFT JOIN tblsubcategory as sc on sc.SubCategoryId = p.SubCategoryId ' .
            'ORDER BY p.view DESC ' .
            'LIMIT 5';
        $query = mysqli_query($this->connection, $sql);

        if (!$query) {
            throw new \Exception('Query error!');
        }

        return mysqli_fetch_all($query, MYSQLI_ASSOC);
    }

    /**
     * @param int $postId
     *
     * @return bool
     */
    public function incrementView($postId)
    {
        return (bool) mysqli_query(
            $this->connection,
            'UPDATE tblposts SET view = IFNULL(view, 0) + 1 WHERE id = ' . $postId
        );
    }
}