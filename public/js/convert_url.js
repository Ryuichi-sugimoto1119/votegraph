jQuery (function ()
{
    // ユーザー情報取得
    const user_id = localStorage.getItem('user_id')
    // カード全体のhrefにuseridを付与する
    for(let k in $('.card')) {
        if ($('.card')[k].href !== undefined) {
            $('.card')[k].href = $('.card')[k].href + '/?user_id=' + user_id
        }
    }
    
})
