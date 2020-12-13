jQuery (function ()
{
    // ユーザー情報取得
    const user_id = localStorage.getItem('user_id')
    $('<input>').attr({
        type: 'hidden',
        id: 'user',
        name: 'user_id',
        value: user_id
    }).appendTo('form');
})
