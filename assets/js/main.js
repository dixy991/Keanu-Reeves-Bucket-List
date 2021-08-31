window.onload = function () {
    let url = location.href;
    if (url.indexOf("page=list") != -1) {
        dohvatanjePagination(0);
    }
    $("#spiner").addClass("sakrij");
    $("#done").hide();
    $("#newmenu").hide();
    $("#newcat").hide();
    $("#newlist").hide();
    $("#editlist").hide();
    $("#user-form").hide();
    $("#juzer").next().hide();
    $("#juzer").click(function (e) {
        e.preventDefault();
        $("#juzer").next().toggle("slow", function () { });
    })
    $("#dugmeRegister").click(proveraRegister);
    $("#dugmeLogin").click(proveraLogin);
    $("#dugmeContact").click(proveraContact);
    $(".dugmeBucket").click(izaberiZaBucket);
    $(".dugmeRemoveCat").click(deleteCategory);
    $(".dugmeRemoveMenu").click(deleteMenu);
    $(".dugmeEditUser").click(editUser);
    $(".dugmeRemoveUser").click(deleteUser);
    $(".dugmeEditList").click(editList);
    $(".dugmeRemoveList").click(deleteList);
    $(".aktiviraj").click(flipLinks);
    $(".backArrow").click(goBack);
    $("#changeUser").click(changeUser);
    $("#filter").change(filterNsortList);
    $("#sort").change(filterNsortList);
}
//provere
function proveraRegister() {
    let validno = true;
    let username = $("#username").val().trim();
    let email = $("#email").val().trim();
    let password = $("#password").val().trim();

    let remail = /^[A-z0-9\.\_\-]+\@[A-z0-9\.\_\-]+(\.[A-z]{2,})+$/;
    let rePass = /^[A-z0-9]{7,50}$/;
    let reUser = /^[\w\d\s\.\-\@\_]{5,50}$/;

    if (username == "") {
        validno = false;
        $("#username").css("border-bottom", "2px solid red");
    }
    else if (!reUser.test(username)) {
        validno = false;
        $("#username").css("border-bottom", "2px solid red");
        $("#username").next().html("At least 5 characters!");
    }
    else {
        $("#username").css("border-bottom", "2px solid green");
        $("#username").next().html("");
    }

    if (email == "") {
        validno = false;
        $("#email").css("border-bottom", "2px solid red");
    }
    else if (!remail.test(email)) {
        validno = false;
        $("#email").css("border-bottom", "2px solid red");
        $("#email").next().html("Gotta have @ in it and 2 domains after!<br/> Like this: try.again@gmail.com");
    }
    else {
        $("#email").css("border-bottom", "2px solid green");
        $("#email").next().html("");
    }

    if (password == "") {
        validno = false;
        $("#password").css("border-bottom", "2px solid red");
    }
    else if (!rePass.test(password)) {
        validno = false;
        $("#password").css("border-bottom", "2px solid red");
        $("#password").next().html("At least 7 characters!<br/>**Only letters and numbers!");
    }
    else {
        $("#password").css("border-bottom", "2px solid green");
        $("#password").next().html("");
    }

    if (validno) {
        var obj = {
            username: username,
            email: email,
            password: password,
            send: true
        };

        $.ajax({
            url: "models/user/register.php",
            method: "POST",
            data: obj,
            success: function (data) {
                $("#message").html(data.message);
                console.log(data)
            },
            error: function (xhr, status, error) {
                var poruka = "Oops, an error occurred...";
                console.log(xhr)
                console.log(xhr.responseJSON)
                var i;
                switch (xhr.status) {
                    case 404: poruka = "Page not found!"; break;
                    case 409: poruka = "Username or email already exists!"; break;
                    case 422: poruka = "Values are not valid!"; break;
                    case 500: poruka = "Error"; break;
                }
                // $("#poruka").css("border","2px solid red");
                $("#message").html(poruka + "<br/>");
                for (i of xhr.responseJSON) {
                    $("#message").append(i);
                }
            }
        })
    }
}

function proveraLogin() {
    let validno = true;

    let email = $("#email").val().trim();
    let password = $("#password").val().trim();

    let remail = /^[A-z0-9\.\_\-]+\@[A-z0-9\.\_\-]+(\.[A-z]{2,})+$/;

    let rePass = /^[A-z0-9]{7,50}$/;

    if (email == "") {
        validno = false;
        $("#email").css("border-bottom", "2px solid red");
    }
    else if (!remail.test(email)) {
        validno = false;
        $("#email").css("border-bottom", "2px solid red");
        $("#email").next().html("Gotta have @ in it!And be followed by 2 domains.<br/> Like this: try.again@gmail.com");
    }
    else {
        $("#email").css("border-bottom", "2px solid green");
        $("#email").next().html("");
    }
    if (password == "") {
        validno = false;
        $("#password").css("border-bottom", "2px solid red");
    }
    else if (!rePass.test(password)) {
        validno = false;
        $("#password").css("border-bottom", "2px solid red");
        $("#password").next().html("At least 7 characters!<br/>**Only letters and numbers!");
    }
    else {
        $("#password").css("border-bottom", "2px solid green");
        $("#password").next().html("");
    }

    if (validno) {
        return true;
    }
    else {
        return false;
    }
}

function proveraContact() {
    let validno = true;

    let name = $("#name").val().trim();
    let email = $("#email").val().trim();
    let message = $("#message").val().trim();

    let reName = /^[A-Z][a-z]+(\s[A-Z][a-z]+)*$/;
    let remail = /^[A-z0-9\.\_\-]+\@[A-z0-9\.\_\-]+(\.[A-z]{2,})+$/;

    if (name == "") {
        validno = false;
        $("#name").css("border-bottom", "2px solid red");
        $("#name").next().html("");
    }
    else if (!reName.test(name)) {
        validno = false;
        $("#name").css("border-bottom", "2px solid red");
        $("#name").next().html("Gotta all start with an uppercase letter!");
    }
    else {
        $("#name").css("border-bottom", "2px solid green");
        $("#name").next().html("");
    }

    if (email == "") {
        validno = false;
        $("#email").css("border-bottom", "2px solid red");
    }
    else if (!remail.test(email)) {
        validno = false;
        $("#email").css("border-bottom", "2px solid red");
        $("#email").next().html("Gotta have @ in it and 2 domains after!<br/> Like this: try.again@gmail.com");
    }
    else {
        $("#email").css("border-bottom", "2px solid green");
        $("#email").next().html("");
    }

    if (message == "") {
        validno = false;
        $("#message").css("border-bottom", "2px solid red");
        $("#message").next().html("Write something");
    }
    else {
        $("#message").css("border-bottom", "2px solid green");
        $("#message").next().html("");
    }

    if (validno) {
        var obj = {
            name: name,
            email: email,
            message: message,
            send: true
        };

        $.ajax({
            url: "models/user/contact.php",
            method: "POST",
            data: obj,
            success: function (data) {
                $("#risponse").html(data.success);
                console.log(data)
            },
            error: function (xhr, status, error) {
                var poruka = "Oops, an error occurred...";
                console.log(xhr)
                console.log(xhr.responseJSON)
                var i;
                switch (xhr.status) {
                    case 404: poruka = "Page not found!"; break;
                    case 422: poruka = "Values are not valid!"; break;
                    case 500: poruka = "Error"; break;
                }
                $("#risponse").css("color", "red");
                $("#risponse").html(poruka + "<br/>");
                for (i of xhr.responseJSON) {
                    $("#risponse").append(i);
                }
            }
        })
    }
}

function proveraCreate() {
    let validno = true;

    let name = $("#name").val().trim();
    let category = $("#category").val();
    let picture = $("#picture").val();
    console.log(name, category, picture)

    let path = picture.split(".");
    let format = path[path.length - 1];

    let reFormat = /^(jpg|jpeg|png)$/;

    if (name == "") {
        validno = false;
        $("#name").css("border-bottom", "2px solid red");
    }
    else {
        $("#name").css("border-bottom", "2px solid green");
    }

    if (category == "0") {
        validno = false;
        $("#category").addClass("text-danger");
    }
    else {
        $("#category").addClass("text-success");
    }

    if (picture == "") {
        validno = false;
        $("#picture").css("border", "2px solid red");
    }
    else if (!reFormat.test(format)) {
        validno = false;
        $("#picture").css("border", "2px solid red");
        $("#picture").next().html("Must be a picture in jpg/jpeg/png format!");
    }
    else {
        $("#picture").css("border", "2px solid green");
        $("#picture").next().html("");
    }

    if (validno) return true;
    else return false;
}

function proveraNewCat(){
    let validno = true;

    let name = $("#name").val().trim();

    if (name == "") {
        validno = false;
        $("#name").css("border-bottom", "2px solid red");
    }
    else {
        $("#name").css("border-bottom", "2px solid green");
    }

    if (validno) return true;
    else return false;
}

function proveraNewMenu(){
    let validno = true;

    let name = $("#nameMenu").val().trim();
    let path = $("#namePath").val().trim();
    let parent = $("#numParent").val().trim();
    let position = $("#numPosition").val().trim();
    
    let regP=/^[0-9]+$/

    if (name == "") {
        validno = false;
        $("#nameMenu").css("border-bottom", "2px solid red");
    }
    else {
        $("#nameMenu").css("border-bottom", "2px solid green");
    }

    if (path == "") {
        validno = false;
        $("#namePath").css("border-bottom", "2px solid red");
    }
    else if(path.indexOf("index.php?page=")==-1){
        validno = false;
        $("#namePath").css("border-bottom", "2px solid red");
        $("#namePath").val("index.php?page=");
    }
    else {
        $("#namePath").css("border-bottom", "2px solid green");
    }

    if (parent == "") {
        validno = false;
        $("#numParent").css("border-bottom", "2px solid red");
        $("#numParent").attr("placeholder","Put 0 if it doesn't have a parent!");
    }
    else if(!regP.test(parent)){
        validno = false;
        $("#numParent").css("border-bottom", "2px solid red");
        $("#numParent").next().html("Only numbers!");
    }
    else {
        $("#numParent").css("border-bottom", "2px solid green");
    }

    if (position == "") {
        validno = false;
        $("#numPosition").css("border-bottom", "2px solid red");
    }
    else if(!regP.test(position)){
        validno = false;
        $("#numPosition").css("border-bottom", "2px solid red");
        $("#numPosition").next().html("Only numbers!");
    }
    else {
        $("#numPosition").css("border-bottom", "2px solid green");
    }

    if (validno) return true;
    else return false;
}
//paginacija
function dohvatanjePagination(perpage) {
    $.ajax({
        url: "models/list/pagination.php",//dohvata brojeve, tj kolko ih ima
        method: "POST",
        data: {
            perpage: perpage,
            send: true
        },
        success: function (data) {
            ispisPagination(data);
            console.log(data)
        },
        error: function (xhr, status, error) {
            var poruka = "Oops, an error occurred...";
            console.log(xhr)
            console.log(xhr.responseJSON)
            var i;
            switch (xhr.status) {
                case 500: poruka = "Error"; break;
            }
            // $("#poruka").css("border","2px solid red");
            $("#poruka").html(poruka + "<br/>");
            for (i of xhr.responseJSON) {
                $("#poruka").append(i);
            }
        }
    })
}

function ispisPagination(data) {
    let ispis = "";
    let sum = data.allLists;
    let links = Math.ceil(sum / 3);
    for (let i = 1; i <= links; i++) {
        ispis += `<li class="page-item"><a class="page-link paginatedLinks" data-perpage="${i}" href="#">${i}</a></li>`;
    }

    $("#paginacija").html(ispis);
    $(".paginatedLinks").click(pagination);
}

function pagination(e) {
    e.preventDefault();
    let page = $(this).data("perpage");
    let idSort = $("#sort").val();
    let idFilterKat = $("#filter").val();
    console.log(page, idSort, idFilterKat)

    $.ajax({
        url: "models/category/filterNsort.php",
        method: "POST",
        data: {
            page: page,
            idSort: idSort,
            idFilterKat: idFilterKat,
            send: true
        },
        success: function (data) {
            ispisLista(data);
            console.log(data)
        },
        error: function (xhr, status, error) {
            var poruka = "Oops, an error occurred...";
            console.log(xhr)
            console.log(xhr.responseJSON)
            var i;
            switch (xhr.status) {
                case 500: poruka = "Error"; break;
            }
            // $("#poruka").css("border","2px solid red");
            $("#poruka").html(poruka + "<br/>");
            for (i of xhr.responseJSON) {
                $("#poruka").append(i);
            }
        }
    })
}

function ispisLista(data) {
    console.log("gledaj ovo +" + data)
    let added = []
    for (let d of data[1]) {
        if (d == null) added.push(0);
        else added.push(d.total)
    }
    let done = []
    for (let d of data[2]) {
        if (d == null) done.push(0);
        else done.push(d.total)
    }
    let ispis = "";
    for (let [index, element] of data[0].entries()) {
        ispis += `
            <div class="media my-3 mb-5 tm-service-media okreci">
                <img src="assets/img/lists/${element.src}" alt="${element.alt}" class="tm-service-img">
                <div class="media-body tm-service-text">
                    <h2 class="mt-5 tm-content-title">${element.listName}</h2>
                    <!-- ovde ce biti ukuono,uradjeno i dodaj -->
            `;
        if ($("#idUser").val() == 0) {
            ispis += `
                <p class="text-danger">Gotta login to have your bucket filled in!</p>
                `;
        }
        else {
            ispis += `
                <button type="button" class="btn btn-secondary plavo mt-4 dugmeBucket" data-idlist="${element.id_list}" name="">Pick up!</button>
                <i class="fas fa-plus fa-1x ml-5"></i> <span>${added[index]} Added</span>
                <i class="fas fa-check-square fa-1x ml-1 "></i> <span>${done[index]} Done</span>
                `;
        }
        ispis += `
                <p></p>
                </div>
            </div>
            `;

    }
    $("#liste").html(ispis);
    $(".dugmeBucket").click(izaberiZaBucket);
}
//filter i sort
function filterNsort() {
    let idFilterKat = $("#filter").val();
    let idSort = $("#sort").val();
    // $("#sort").val(0);
    dohvatanjePagination(idFilterKat);

    $.ajax({
        url: "models/category/filterNsort.php",
        method: "POST",
        data: {
            idFilterKat: idFilterKat,
            idSort: idSort,
            page: 1,
            send: true
        },
        success: function (data) {
            ispisLista(data);
            console.log(data)
        },
        error: function (xhr, status, error) {
            var poruka = "Oops, an error occurred...";
            console.log(xhr)
            console.log(xhr.responseJSON)
            var i;
            switch (xhr.status) {
                case 500: poruka = "Error"; break;
            }
            $("#poruka").html(poruka);
        }
    })
}
//JEDNA F-JA ZAPRAVO!!!
// function sortList() {
//     let idSort = $(this).val();
//     let idFilterKat = $("#filter").val();
//     dohvatanjePagination(idFilterKat);

//     $.ajax({
//         url: "models/category/filterNsort.php",
//         method: "POST",
//         data: {
//             idSort: idSort,
//             idFilterKat: idFilterKat,
//             page: 1,
//             send: true
//         },
//         success: function (data) {
//             ispisLista(data);
//             console.log(data)
//         },
//         error: function (xhr, status, error) {
//             var poruka = "Oops, an error occurred...";
//             console.log(xhr)
//             console.log(xhr.responseJSON)
//             var i;
//             switch (xhr.status) {
//                 case 500: poruka = "Error"; break;
//             }
//             $("#poruka").html(poruka);
//         }
//     })
// }
//listNbucket
function izaberiZaBucket() {
    let idList = $(this).data("idlist");
    let idUser = $("#idUser").val();
    let dugme = $(this).html("Picked up!");
    console.log(idList, idUser)

    $.ajax({
        url: "models/bucket/insert.php",
        method: "POST",
        data: {
            idList: idList,
            idUser: idUser,
            send: true
        },
        success: function (data) {
            console.log(data)
        },
        error: function (xhr, status, error) {
            var poruka = "Oops, an error occurred...";
            console.log(xhr)
            console.log(xhr.responseJSON)
            var i;
            switch (xhr.status) {
                case 409: poruka = "Already chosen..."; break;
                case 500: poruka = "Error"; break;
            }
            $(dugme).html(poruka);
        }
    })
}

function flipLinks(e) {
    e.preventDefault();
    $(this).removeClass("text-light");
    $(this).siblings(".aktiviraj").addClass("text-light");
    let link = $(this).attr("href")
    console.log(link)
    if (link == "#done") {
        $("#done").show();
        $("#todo").hide();
    }
    else if (link == "#todo") {
        $("#done").hide();
        $("#todo").show();
    }
    else if (link == "#allcat") {
        $("#newcat").hide();
        $("#allcat").show();
    }
    else if (link == "#newcat") {
        $("#newcat").show();
        $("#allcat").hide();
    }
    else if (link == "#alllists") {
        $("#alllists").show();
        $("#newlist").hide();
        $("#editlist").hide();
    }
    else if (link == "#newlist") {
        $("#newlist").show();
        $("#alllists").hide();
        $("#editlist").hide();
    }
    else if (link == "#allmenu") {
        $("#newmenu").hide();
        $("#allmenu").show();
    }
    else if (link == "#newmenu") {
        $("#newmenu").show();
        $("#allmenu").hide();
    }

}
//category
function deleteCategory() {
    let idCat = $(this).data("idcat");
    console.log(idCat)

    $.ajax({
        url: "models/category/delete.php",
        method: "POST",
        data: {
            idCat: idCat,
            send: true
        },
        success: function (data) {
            console.log(data)
            location.reload();
        },
        error: function (xhr, status, error) {
            var poruka = "Oops, an error occurred...";
            console.log(xhr)
            console.log(xhr.responseJSON)
            var i;
            switch (xhr.status) {
                case 500: poruka = "Error"; break;
            }
            $("#poruka").html(poruka);
        }
    })
}

function deleteMenu(){
    let idMenu = $(this).data("idmenu");
    console.log(idMenu)

    $.ajax({
        url: "models/list/delete.php",
        method: "POST",
        data: {
            idMenu: idMenu,
            sendMenu: true
        },
        success: function (data) {
            console.log(data)
            location.reload();
        },
        error: function (xhr, status, error) {
            var poruka = "Oops, an error occurred...";
            console.log(xhr)
            console.log(xhr.responseJSON)
            var i;
            switch (xhr.status) {
                case 500: poruka = "Error"; break;
            }
            $("#poruka").html(poruka);
        }
    })
}
//user
function editUser() {
    let idUser = $(this).data("iduser");
    console.log(idUser)

    $.ajax({
        url: "models/user/edit.php",
        method: "POST",
        data: {
            idUser: idUser,
            send: true
        },
        success: function (data) {
            console.log(data)
            $("#user-form").show();
            $("#user-table").hide();
            ispisiUserVrednosti(data)
        },
        error: function (xhr, status, error) {
            var poruka = "Oops, an error occurred...";
            console.log(xhr)
            console.log(xhr.responseJSON)
            var i;
            switch (xhr.status) {
                case 500: poruka = "Error"; break;
            }
            $("#poruka").html(poruka);
        }
    })
}

function ispisiUserVrednosti(data) {
    $("#idUser").val(data.id_user);
    $("#username").val(data.username);
    $("#email").val(data.email);
    if (data.active == 1) $("#active").prop("checked", true)
    else $("#non-active").prop("checked", true)
    $("#role > option").each(function () {
        if (data.role_ID == this.value) $(this).attr('selected', 'selected');
    });
}

function goBack() {
    if ($(this).data("back") == "user") {
        $("#user-form").hide();
        $("#user-table").show();
    }
    else if ($(this).data("back") == "list") {
        $("#editlist").hide();
        $("#alllists").show();
    }
}

function changeUser() {
    let validno = true;

    let idUser = $("#idUser").val();
    let username = $("#username").val().trim();
    let email = $("#email").val().trim();
    let active = $("input[type=radio]:checked").val();
    let role = $("#role").val();
    console.log(active, role)

    let reUser = /^[\w\d\.\-\@\_]{7,50}$/;
    let remail = /^[A-z0-9\.\_\-]+\@[A-z0-9\.\_\-]+(\.[A-z]{2,})+$/;

    if (username == "") {
        validno = false;
        $("#username").css("border-bottom", "2px solid red");
    }
    else if (!reUser.test(username)) {
        validno = false;
        $("#username").css("border-bottom", "2px solid red");
        $("#username").next().html("At least 7 characters!");
    }
    else {
        $("#username").css("border-bottom", "2px solid green");
        $("#username").next().html("");
    }

    if (email == "") {
        validno = false;
        $("#email").css("border-bottom", "2px solid red");
    }
    else if (!remail.test(email)) {
        validno = false;
        $("#email").css("border-bottom", "2px solid red");
        $("#email").next().html("Gotta have @ in it!<br/> Like this: try.again@gmail.com");
    }
    else {
        $("#email").css("border-bottom", "2px solid green");
        $("#email").next().html("");
    }

    if (validno) {
        var obj = {
            idUser: idUser,
            username: username,
            email: email,
            active: active,
            role: role,
            send: true
        };

        $.ajax({
            url: "models/user/update.php",
            method: "POST",
            data: obj,
            success: function (data) {
                console.log(data)
                location.reload()
            },
            error: function (xhr, status, error) {
                var poruka = "Oops, an error occurred...";
                console.log(xhr)
                console.log(xhr.responseJSON)
                var i;
                switch (xhr.status) {
                    case 404: poruka = "Page not found!"; break;
                    case 422: poruka = "Values are not valid!"; break;
                    case 500: poruka = "Error"; break;
                }
                $("#poruka").html(poruka + "<br/>");
                for (i of xhr.responseJSON) {
                    $("#poruka").append(i);
                }
            }
        })
    }
}

function deleteUser() {
    let idUser = $(this).data("iduser");

    $.ajax({
        url: "models/user/delete.php",
        method: "POST",
        data: {
            idUser: idUser,
            send: true
        },
        success: function (data) {
            console.log(data)
            location.reload();
        },
        error: function (xhr, status, error) {
            var poruka = "Oops, an error occurred...";
            console.log(xhr)
            console.log(xhr.responseJSON)
            var i;
            switch (xhr.status) {
                case 500: poruka = "Error"; break;
            }
            $("#poruka").html(poruka);
        }
    })
}
//list
function editList() {
    let idList = $(this).data("idlist");
    console.log(idList)

    $.ajax({
        url: "models/list/edit.php",
        method: "POST",
        data: {
            idList: idList,
            send: true
        },
        success: function (data) {
            console.log(data)
            $("#editlist").show();
            $("#alllists").hide();
            ispisiListVrednosti(data)
        },
        error: function (xhr, status, error) {
            var poruka = "Oops, an error occurred...";
            console.log(xhr)
            console.log(xhr.responseJSON)
            var i;
            switch (xhr.status) {
                case 500: poruka = "Error"; break;
            }
            $("#poruka").html(poruka);
        }
    })
}

function ispisiListVrednosti(data) {
    $("#idList").val(data.id_list);
    $("#editImage").attr("src","assets/img/lists/"+data.src);
    $("#editName").val(data.name);
    $("#editCategory > option").each(function () {
        if (data.category_ID == this.value) $(this).attr('selected', 'selected');
    });
}

function changeList() {
    let validno = true;

    let name = $("#editName").val().trim();
    // console.log(active, role)

    if (name == "") {
        validno = false;
        $("#editName").css("border-bottom", "2px solid red");
    }
    else {
        $("#editName").css("border-bottom", "2px solid green");
        $("#editName").next().html("");
    }

    if(validno) return true;
    else return false;
}

function deleteList() {
    let idList = $(this).data("idlist");

    $.ajax({
        url: "models/list/delete.php",
        method: "POST",
        data: {
            idList: idList,
            send: true
        },
        success: function (data) {
            console.log(data)
            location.reload();
        },
        error: function (xhr, status, error) {
            var poruka = "Oops, an error occurred...";
            console.log(xhr)
            console.log(xhr.responseJSON)
            var i;
            switch (xhr.status) {
                case 500: poruka = "Error"; break;
            }
            $("#poruka").html(poruka);
        }
    })
}