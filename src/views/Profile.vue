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
                  <h3 class="title">Kontti</h3>
                  <h6>Second hand shop</h6>
                  
                </div>
              </div>
            </div>
          </div>
          <div class="description text-center">
            <p>
              Enter details of your business
            </p>
          </div>
            
              <div id='vueapp' class = "md-layout">

              <form>
              <br>
              <div class="flex-column">
                <label>Vendor Name  </label>
                <input type="text" name="name" v-model="vendorName">
              </div>
              <br>

              <div class="flex-column">
              <label>Address </label>
              <input type="text" name="address" v-model="address">
              </div>
              <br>

              <div class="flex-column">
                <label>Website  </label>
                <input type="text" name="name" v-model="website">
              </div>
              <br>

              <div class="flex-column">
              <label>Phone no </label>
              <input type="text" name="address" v-model="phone">
              </div>
              <br>

              <div class="flex-column">
                <label>Description of shop </label>
                <input type="text" name="name" v-model="description">
              </div>
              <br>

              <div class="flex-column">
              <label>Working hours </label>
              <input type="text" name="address" v-model="workingHours">
              </div>
              <br> 
                
                <div class="flex-column">
                  <label>Category of product:  </label>
                  <input type="checkbox" id="product1" name="categoryId" value="1">
                  <label for="product1">Utensils </label>
                  <input type="checkbox" id="product2" name="categoryId" value="2">
                  <label for="product2">Furniture </label>
                  <input type="checkbox" id="product3" name="categoryId" value="3">
                  <label for="product3">Digital devices </label><br>
                </div>
                <br>
                <div class="flex-column">
                  <label>Type of product:  </label>
                  <input type="checkbox" id="type1" name="vendorType" value="1">
                  <label for="type1">New items </label>
                  <input type="checkbox" id="type2" name="vendorType" value="2">
                  <label for="type2">Used items </label>
                  <input type="checkbox" id="type3" name="vendorType" value="3">
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
              <input type="file" name="file">
              </div>
              <br>
                <div class="md-layout">
        <div class="md-layout-item md-size-66 mx-auto">
          <md-button class="md-success" click = "@vender_registration"> Submit </md-button>
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
      userName: null,
      password: null
    };
  },
  props: {
    header: {
      type: String,
      default: require("@/assets/img/city-profile.jpg")
    },
    img: {
      type: String,
      default: require("@/assets/img/faces/shopImg.jpg")
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
  vendor_registration(){
        
        let formData = new FormData();
        formData.append('vendorName', this.userName);
        formData.append('password', this.password);

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
              window.location.href = 'http://localhost:8080/#/profile';
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
