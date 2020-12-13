jQuery (function ()
{
    // ユーザー情報取得
    const user_id = localStorage.getItem('user_id')
    // hrefにuseridを付与する
    for(let k in $('.detail')) {
        if ($('.detail')[k].href !== undefined) {
            $('.detail')[k].href = $('.detail')[k].href + '/?user_id=' + user_id
        }
    }
    
})
