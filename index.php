<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upwatch - Service</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/fontawesome-all.min.css">
    <link rel="stylesheet" type="text/css" href="css/iofrm-style.css">
    <link rel="stylesheet" type="text/css" href="css/iofrm-theme26.css">
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
</head>
<body>
    <div class="form-body" id="app">
        <div class="website-logo">
            <a href="#">
                <div class="logo">
                    <img class="logo-size" src="images/logo.png" alt="logo">
                </div>
            </a>
        </div>
        <div class="row">
            <div class="img-holder">
                <div class="bg"></div>
                <div class="info-holder">
                    <h2>Size yardım etmeye hazırız.<br><span>Her zaman.</span></h2>
                </div>
            </div>
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <div class="logo-mobile">
                            <img class="logo-size" src="images/logo.png" alt="logo">
                        </div>
                        <div v-if="alertBool">
                            <h6 class="statusText">
                              <i class="fa fa-info-circle"></i>  {{ service_status }}
                            </h6>
                        </div>
                        <h3>Lütfen formu eksiksiz doldurunuz.</h3>
                        <p>Bir servis takip numaranız yok mu ?<br>
                            <b>
                                <a href="https://www.upwatch.com/ac/iletisim" rel="nofollow" target="blank"> Bize </a> ulaşın.
                            </b>
                        </p>
                        <form @submit.stop.prevent="onSubmit">
                            <div class="form-row">
                                <div class="col">
                                    <input type="text" class="form-control" placeholder="Müşteri no." v-model.trim="customer_no">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <input type="text" class="form-control" placeholder="Servis Takip no." v-model.trim="service_no">
                                </div>
                            </div>
                            <div class="form-button">
                                <button id="submit" type="submit" class="ibtn extra-padding">Durumu görüntüle </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/0.6.1/vue-resource.min.js" 
integrity="sha512-NuUIe6TWdEivPTcxnihx2e6r2xQFEFPrJfpdZWoBwZF6G51Rphcf5r/1ZU/ytj4lyHwLd/YGMix4a5LqAN15XA==" 
crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    /*Root api url*/
    Vue.http.options.root = 'https://jsonplaceholder.typicode.com';
    var app = new Vue({ 
        el: '#app',
        data() {
            return {
                alertBool:false,
                customer_no:'',
                service_no:'',
                service_status:null
            }
        },
        methods:{
            getServiceStatus(){
                this.$resource('todos/').get({id:this.customer_no}).then((response) => {
                  this.service_status = response.data[0].title;
                  this.alertBool = true;
                })
            },
            onSubmit(){
                if(this.customer_no!=='' && this.service_no!==''){
                    this.getServiceStatus();
                }else{
                    this.alertBool=true;
                    this.service_status="Lütfen bilgilerinizi eksiksiz giriniz!";
                }
            }
        }
    });
</script>
</body>
</html>