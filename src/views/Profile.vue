<template>
  <div class="wrapper">
    <parallax
      class="section page-header header-filter"
      :style="headerStyle"
    ></parallax>
    <div class="main main-raised">
      <div class="section profile-content">
        <div class="container">
          <div class="md-layout">
            <div class="md-layout-item md-size-50 mx-auto">
              <div class="profile">
                <div class="avatar">
                  <img
                    :src="img"
                    alt="Circle Image"
                    class="img-raised rounded"
                  />
                </div>
                <div class="name">
                  <h3 class="title" name="title"></h3>
                  <h6>Enter details of your business</h6>
                  
                </div>
              </div>
            </div>
          </div>
            
              <div id='vueapp' class = "md-layout">

              <form>
              <br>
              <div class="flex-column">
                <label>Vendor Name  </label>
                <input type="text" name="vendorName" v-model="vendorName">
              </div>
              <br>

              <div class="flex-column">
              <label>Address </label>
              <input type="text" name="address" v-model="address">
              </div>
              <br>

              <div class="flex-column">
                <label>Website  </label>
                <input type="text" name="website" v-model="website">
              </div>
              <br>

              <div class="flex-column">
              <label>Phone no </label>
              <input type="text" name="phone" v-model="phone">
              </div>
              <br>

              <div class="flex-column">
                <label>Description of shop </label>
                <input type="text" name="description" v-model="description">
              </div>
              <br>

              <div class="flex-column">
              <label>Working hours </label>
              <input type="text" name="workingHours" v-model="workingHours">
              </div>
              <br> 
                
                <div class="flex-column">
                  <label>Category of product:  </label>
                  <input type="checkbox" class="product" name="categoryId[]" value="1">
                  <label for="product">Utensils </label>
                  <input type="checkbox" class="product" name="categoryId[]" value="2">
                  <label for="product">Furniture </label>
                  <input type="checkbox" class="product" name="categoryId[]" value="3">
                  <label for="product">Digital devices </label><br>
                </div>
                <br>
                <div class="flex-column">
                  <label>Type of product:  </label>
                  <input type="checkbox" class="vendor" name="vendorType[]" value="1">
                  <label for="type1">New items </label>
                  <input type="checkbox" class="vendor" name="vendorType[]" value="2">
                  <label for="type2">Used items </label>
                  <input type="checkbox" class="vendor" name="vendorType[]" value="3">
                  <label for="type3">Recycled items </label><br>
                </div>

              <br>
              <div class="flex-column">
              <label>Price range of product </label>
              <input type="text" name="priceRange" v-model="priceRange">
              </div>
              <br>

              <div class="flex-column">
              <label>Upload image </label>
              <input type="file" name="file[]" @change="handleUpload($event.target.files)">
              </div>
              <br>

              <div class="flex-column">
              <label>LatLong </label>
              <input type="text" name="latitude" v-model="latitude">
              <input type="text" name="longitude" v-model="longitude">
              </div>
              <br>

                <div class="md-layout">
        <div class="md-layout-item md-size-66 mx-auto">
          <md-button class="md-success" @click = "vendor_registration"> Submit </md-button>
        </div>
      </div>

              </form>

<div class="space-0"></div>

</div>  

<div class="space-100"></div>
        </div>
      </div>
    </div>
  </div>
  
</template>

<script>
import { axios } from '@/plugins/axios'

export default {
  components: {
    
  },
  bodyClass: "profile-page",
  data() {
    return {
      vendorName: null,
      categoryId: null,
      address: null,
      phone: null,
      website: null,
      priceRange: null,
      vendorType: null,
      description: null,
      workingHours: null,
      latitude: null,
      longitude: null,
      file: null
    };
  },
  props: {
    header: {
      type: String,
      default: require("@/assets/img/city-header.jpg")
    },
    img: {
      type: String,
      default: require("@/assets/img/Logo.png")
    }
  },
  computed: {
    headerStyle() {
      return {
        backgroundImage: `url(${this.header})`
      };
    }
  },

methods: {
  handleUpload(files) {
          this.file = files[0];
        },
  vendor_registration(){
        var products = document.querySelectorAll('.product:checked');
        this.categoryId = "";
        for(var i = 0; i < products.length ; i ++){
            if(i + 1 == products.length){
                this.categoryId += products[i].value;
            }else{
                this.categoryId += products[i].value + ",";
            }
        }

        var vendors = document.querySelectorAll('.vendor:checked');
        this.vendorType = "";
        for(var i = 0; i < vendors.length ; i ++){
            if(i + 1 == vendors.length){
                this.vendorType += vendors[i].value;
            }else{
                this.vendorType += vendors[i].value + ",";
            }
        }

        console.log(this.categoryId);
        let formData = new FormData();
        formData.append('vendorName', this.vendorName);
        formData.append('categoryId', this.categoryId);
        formData.append('address', this.address);
        formData.append('phone', this.phone);
        formData.append('website', this.website);
        formData.append('priceRange', this.priceRange);
        formData.append('vendorType', this.vendorType);
        formData.append('description', this.description);
        formData.append('workingHours', this.workingHours);
        formData.append('longitude', this.longitude);
        formData.append('latitude', this.latitude);
        formData.append('file', this.file);

        var contact = {};
        formData.forEach(function(value, key){
            contact[key] = value;
        });

        axios({
            method: 'post',
            url: 'http://localhost/ShopDock/vendor_registration.php',
            data: formData,
            config: { headers: {'Content-Type': 'multipart/form-data' }}
        })
        .then(function (response) {
            //handle success
            console.log(response)
            if(response.data.code == "200"){
              window.location.href = 'http://localhost:8080/#/';
            }
            else{
              console.log("Data insertion failed!!!")
            }
        })
        .catch(function (response) {
            //handle error
            console.log(response)
        });
  }
}

};


</script>

<style lang="scss" scoped>
.section {
  padding: 0;
}


input {
  align: center;
  margin-left: 10px;
}

.profile-tabs::v-deep {
  .md-card-tabs .md-list {
    justify-content: center;
  }

  [class*="tab-pane-"] {
    margin-top: 3.213rem;
    padding-bottom: 50px;

    img {
      margin-bottom: 2.142rem;
    }
  }
}
</style>
