(function($){

    let app = {
        requestURL:"/bor_holding/request.php",
        post: (form) => {
            return new Promise((resolve, reject) => {
                if(!(form instanceof FormData)) {
                    $.post(app.requestURL, form, (response) => resolve(response));
                    return false;
                }
                $.ajax({ type: "POST", url: app.requestURL, data: form, processData: false, contentType: false, success: (response) => resolve(response) });
            });
        },

        init:function(){
            app.addEventListener();
        },

        addEventListener:function(){

            $(document).on("submit","[name='login']", async function(){
                if(!$(this).valid()){
                    alert("Bilgiler Yanlış!")
                    return false;
                }
                $(this).append(`<input type="hidden" name="action" value="0">`)
                let response = await app.post($(this).serialize())
                location.reload();
            });

            $(document).on("click", "[data-selector='update']", async function(){

                dataId = $(this).attr("data-id");

                let form = new FormData();
                form.append("action", "1");
                form.append("data_id", $(this).attr("data-id"));

                let html = await app.post(form);

                Swal.fire({
                    html: html,
                    showCancelButton: true,
                    preConfirm: async function(){

                        if(!$("[name='update-car']").valid()) return false;

                        $("[name='update-car']").append(`<input type="hidden" name="data_id" value="${ dataId }">`)
                        $("[name='update-car']").append(`<input type="hidden" name="action" value="2">`)
                        
                        let response = await app.post($("[name='update-car']").serialize());
                        response = JSON.parse(response);

                        alert(response["description"]);
                        if(response["ERR"] == "0"){
                            location.reload();   
                        }

                    }
                });

            });

            $(document).on("click", "[data-selector='delete']", async function(){
                let form = new FormData();
                form.append("action", "3");
                form.append("data_id", $(this).attr("data-id"));

                let response = await app.post(form);
                response = JSON.parse(response);

                alert(response["description"]);
                if(response["ERR"] == "0"){
                    location.reload();   
                }

            });

            $(document).on("submit","[name='add-car']", async function(){
                if(!$(this).valid()){
                    return false;
                }
                $(this).append(`<input type="hidden" name="action" value="4">`);
                let response = await app.post($(this).serialize())
                response = JSON.parse(response);
                
                alert(response["description"]);
                if(response["ERR"] == "0"){
                    location.reload();   
                }
            });

        }

    }

    $(document).ready(function(){
        app.init();
    })

})(jQuery)