$(function () {
    // init: side menu for current page
    $('li#menu-companies').addClass('menu-open active');
    $('li#menu-companies').find('.treeview-menu').css('display', 'block');
    $('li#menu-companies').find('.treeview-menu').find('.add-companies a').addClass('sub-menu-active');

    $('#company-form').validationEngine('attach', {
        promptPosition : 'topLeft',
        scroll: false
    });

        // init: show tooltip on hover
        $('[data-toggle="tooltip"]').tooltip({
            container: 'body'
        });

    // Postal Code Search
    document.querySelector('.api-address').addEventListener('click', () => {
        //Get a value from a text field for a zip code
        const elem = document.getElementById('postcode');
        const postcode = elem.value;
        //Fetching JSON strings from the API with fetch
        fetch('../api/company/getLocalInfo/' + postcode)
        .then((data) => data.json())
        .then((obj) => {
            //If the zip code does not exist, an empty object is returned.
            //Determine if the object is empty
            if (!Object.keys(obj).length) {
                //If the object is empty
                alert("住所が存在しません。");
                txt = '';
                obj.city = '';
                obj.local = '';
            } else {
                //If the object exists
                //Addresses are returned as split data and are concatenated.
                txt = obj.city + obj.local;
                };
                var prefectures = {
                    "北海道":1,
                    "青森県":2,
                    "岩手県":3,
                    "宮城県":4,
                    "秋田県":5,
                    "山形県":6,
                    "福島県":7,
                    "茨城県":8,
                    "栃木県":9,
                    "群馬県":10,
                    "埼玉県":11,
                    "千葉県":12,
                    "東京都":13,
                    "神奈川県":14,
                    "新潟県":15,
                    "富山県":16,
                    "石川県":17,
                    "福井県":18,
                    "山梨県":19,
                    "長野県":20,
                    "岐阜県":21,
                    "静岡県":22,
                    "愛知県":23,
                    "三重県":24,
                    "滋賀県":25,
                    "京都府":26,
                    "大阪府":27,
                    "兵庫県":28,
                    "奈良県":29,
                    "和歌山県":30,
                    "鳥取県":31,
                    "島根県":32,
                    "岡山県":33,
                    "広島県":34,
                    "山口県":35,
                    "徳島県":36,
                    "香川県":37,
                    "愛媛県":38,
                    "高知県":39,
                    "福岡県":40,
                    "佐賀県":41,
                    "長崎県":42,
                    "熊本県":43,
                    "大分県":44,
                    "宮崎県":45,
                    "鹿児島県":46,
                    "沖縄県":47};
                    const prefecture = obj.prefecture;
                    const prefecture_id = prefectures[prefecture];
                //Write a string in a text field for entering an address
                document.getElementById('prefecture_id').value = prefecture_id;
                document.getElementById('city').value = obj.city;
                document.getElementById('local').value = obj.local;
                document.getElementById('street_address').value = txt;
            });
    });


    // //a init: show tooltip on hover
    // $('[data-toggle="tooltip"]').tooltip({
    //     container: 'body'
    // });

    // // show password field only after 'change password' is clicked
    // $('#reset-button').click(function (e) {
    //     $('#reset-field').removeClass('hide');
    //     $('#show-password-check').removeClass('hide');
    //     // to always uncheck the checkbox after button click
    //     $('#show-password').prop('checked', false);
    // });

    // // toggle password in plaintext if checkbox is selected
    // $("#show-password").click(function () {
    //     $(this).is(":checked") ? $("#password").prop("type", "text") : $("#password").prop("type", "password");
    // });
});
