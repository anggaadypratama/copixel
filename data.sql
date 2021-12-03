
/* Get by profile data*/
SELECT
    Post.id_post,
    Post.title,
    Post.img_post,
    Post.description,
    Post.created_time,
    Post.id_users,
    Users.name,
    Users.img_profile
FROM Post
INNER JOIN Users
ON Post.id_users = Users.id_users
WHERE id_users = "75938662"
