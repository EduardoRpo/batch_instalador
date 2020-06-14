$('input#name-submit').on('click', cargarData)

function cargarData() {
    var name = $('select#name').val();
    if ($.trim(name) != '') {
        $.post('../html/controller/savedata.php', {name: name}, function (data) {

            $('#name-data').val(data);

        });
        $.post('../html/controller/savedata2.php', {name: name}, function (data) {

            $('#name-data2').val(data);

        });
        $.post('../html/controller/savedata3.php', {name: name}, function (data) {

            $('#name-data3').val(data);

        });
        $.post('../html/controller/savedata4.php', {name: name}, function (data) {

            $('#name-data4').val(data);

        });
        $.post('../html/controller/savedata5.php', {name: name}, function (data) {

            $('#name-data5').val(data);

        });
        $.post('../html/controller/savedata6.php', {name: name}, function (data) {

            $('#name-data6').val(data);
            $('#name-data6').number(true, 0, ',', '.');

        });
        $.post('../html/controller/savedata7.php', {name: name}, function (data) {

            $('#name-data7').val(data);

        });
        $.post('../html/controller/savedata9.php', {name: name}, function (data) {

            $('#densidad_in').val(data);

        });

    }
}