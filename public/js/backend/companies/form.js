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
        const url_info = location.protocol + '//' + location.hostname;
        //Fetching JSON strings from the API with fetch
        fetch(url_info + '/api/company/getLocalInfo/' + postcode)
        .then((data) => data.json())
        .then((obj) => {
            //If the zip code does not exist, an empty object is returned.
            //Determine if the object is empty
            if (!Object.keys(obj).length) {
                //If the object is empty
                alert("郵便番号に一致する住所が存在しません。");
                txt = '';
                obj.city = '';
                obj.local = '';
            } else {
                //If the object exists
                //Addresses are returned as split data and are concatenated.
                txt = obj.city + obj.local;
                };
                const prefecture_name = obj.prefecture;
                fetch(url_info + '/api/company/getPrefectures/' + prefecture_name)
                .then((data) => data.json())
                .then((pref) => {
                    const prefecture_id = pref.id;
                    document.getElementById('prefecture_id').value = prefecture_id;
                    document.getElementById('city').value = obj.city;
                    document.getElementById('local').value = obj.local;
                    document.getElementById('street_address').value = txt;
                });
            });
    });

    // Preview process when selecting image files
    $('#image').on('change', function (ev) {
        if (ev.target.files[0]){
            //When image file is selected
            const reader = new FileReader();
            reader.onload = function (ev) {
                $('#img_prv').attr('src', ev.target.result);
            }
            reader.readAsDataURL(this.files[0]);
            let label = document.getElementById("fileImage");
            label.innerHTML = '';
        } else {
            // When no image file is selected
            document.getElementById('fileImage').innerHTML = '画像をアップロードして下さい（推奨サイズ：1280px × 720px・容量は5MBまで）';
		    document.getElementById('img_prv').src = '/img/no-image/no-image.jpg';
        }
        })
});
