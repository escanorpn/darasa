
<template>
  <v-app id="inspire">

 <mdb-edge-header color="" style="background-color: #3c0d0b;margin-top:-12px;">
        <div class="home-page-background"></div>
           <div class="container">
              <!-- <div class="loading-box" v-if="loading1">
                <div class="loader"></div>
              </div> -->
     
           </div>
         
      </mdb-edge-header>
      <v-main class="grey lighten-3">
      <v-container>
        <v-row>
         

          <v-col>
            <v-sheet
              min-height="70vh"
              rounded="lg"
            >
            

  <v-card>
    <v-card-title>
      classes
      <v-spacer></v-spacer>
      <v-text-field
        v-model="search"
        append-icon="mdi-magnify"
        label="Search"
        single-line
        hide-details
      ></v-text-field>
    </v-card-title>
    <v-data-table
   
      :headers="headers"
      :items="mdata"
      :search="search"
      :page.sync="page"
      :items-per-page="itemsPerPage"
      :loading="loading"
      loading-text="Loading... Please wait"
      hide-default-footer
      
      class="selected"
      @page-count="pageCount = $event"
      @click:row="kidato"

    >
     <template v-slot:top>
      <v-toolbar
        flat
      >
       <!-- <a-radio-group v-model="fStudents" @change="fChange" size="small">
        <a-radio-button checked="fchecked" value="a">All</a-radio-button>
        <a-radio-button value="b">students</a-radio-button>
        <a-radio-button value="c">Finance</a-radio-button>
      </a-radio-group> -->
        <!-- <v-toolbar-title>My CRUD</v-toolbar-title> -->
        <v-divider
          class="mx-4"
          inset
          vertical
        ></v-divider>
        <v-spacer></v-spacer>
        <v-dialog
          v-model="dialog"
          max-width="500px"
        >
       
          <v-card>
            <v-card-title>
              <span class="text-h5">{{ formTitle }}</span>
            </v-card-title>

       

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn
                color="blue darken-1"
                text
                @click="close"
              >
                Cancel
              </v-btn>
              <v-btn
                color="blue darken-1"
                text
                @click="save"
              >
                Save
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
        <v-dialog v-model="dialogDelete" max-width="500px">
          <v-card>
            <v-card-title class="text-h5">Are you sure you want to delete this item?</v-card-title>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="closeDelete">Cancel</v-btn>
              <v-btn color="blue darken-1" text @click="deleteItemConfirm">OK</v-btn>
              <v-spacer></v-spacer>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-toolbar>
    </template>
    <template v-slot:item.actions1="{ item }">
      <v-icon
        small
        class="mr-2"
        @click="editItem(item)"
      >
        mdi-pencil
      </v-icon>
     
    </template>
    <template v-slot:item.actions="{ item }">
    
      <v-icon
        small
        @click="deleteItem(item)"
      >
        mdi-delete
      </v-icon>
    </template>
    <template v-slot:no-data>
      <v-btn
        color="primary"
        @click="init"
      >
        Reset
      </v-btn>
    </template>
    
    
    </v-data-table>
    <div class="text-center pt-2">
      <v-pagination
        v-model="page"
        :length="pageCount"
      ></v-pagination>
    
    </div>
    <!-- <div class="loading-box" v-if="loading1">
                <div class="loader"></div>
              </div> -->
      <v-card style="max-width:800px; margin-left:auto;margin-right:auto;margin-top:22px;padding:22px" >
    <v-card-title>
      Add class
      <v-spacer></v-spacer>
      </v-card-title>
  
  
  <v-form
    ref="form"
    v-model="valid"
    lazy-validation
  >

    <v-text-field
      v-model="name"
      :counter="10"
      :rules="nameRules"
      label="Name"
      required
    ></v-text-field>

    <v-btn
      :disabled="!valid"
      color="success"
      class="mr-4"
      @click="validate"
    >
      Submit
    </v-btn>


  </v-form>
   </v-card>
   </v-card>
  
  <!-- <mForm :eItem="eItem" v-if="sItem==true"/> -->
 
   
              <!--  -->
            </v-sheet>
          </v-col>
        </v-row>
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
  // import mForm from "./form.vue"
  import api from "../../services/api";
  
import {   mdbEdgeHeader,  } from 'mdbvue';
  export default {
     components: {
      mdbEdgeHeader,
      // mdbBtn
      // mForm
     },
     
    data: () => ({
      fStudents:'a',
      fts:"All",
      issued:0,
      returned:0,
      cert:0,
      loading1:false,
      valid: true,
      name: '',
      nameRules: [
        v => !!v || 'Name is required',
        v => (v && v.length <= 10) || 'Name must be less than 10 characters',
      ],
      code:'',
      codeRules: [
        v => !!v || 'Code is required',
        v => (v && v.length <= 10) || 'Code must be less than 10 characters',
      ],
      email: '',
      emailRules: [
        v => !!v || 'E-mail is required',
        v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
      ],
      admission: null,
      items: [
        'pending',
        'admitted',
      ],
      mId:'',
      selected: [],
      eItem:[],
      sItem:false,
      links: [
        'Dashboard',
        'Messages',
        'Profile',
        'Updates',
      ],
      page: 1,
      pageCount: 0,
      itemsPerPage: 5,
       search: '',
        headers: [
          // {
          //   text: 'id',
          //   align: 'start',
          //   sortable: false,
          //   value: 'id',
          // },
           { text: 'Actions', value: 'actions1', sortable: false },
          {text: 'Name',value: 'name',},
          {text: 'Students',value: 'c',},
       
          //  { text: 'Actions', value: 'actions', sortable: false },
          // { text: 'Iron (%)', value: 'iron' },
        ],
        mdata: [
          {
            name: 'loading',
          },
        ],
        loading:true,
        dialog: false,
      dialogDelete: false,
      // desserts: [],
      editedIndex: -1,
      editedItem: {
        name: '',
        calories: 0,
        fat: 0,
        carbs: 0,
        protein: 0,
      },
      defaultItem: {
        name: '',
        calories: 0,
        fat: 0,
        carbs: 0,
        protein: 0,
      },
    }),
    
    computed: {
      formTitle () {
        return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
      },
    },

    watch: {
      dialog (val) {
        val || this.close()
      },
      dialogDelete (val) {
        val || this.closeDelete()
      },
    },

    created () {
      // this.initialize()
    },
    methods:{
      sClose(){
        this.sItem=false;
      },
          validate () {
        this.$refs.form.validate()
const nClass={
  id:this.mId,
  name:this.name,
}
this.loading = true;
        api.post('kidato',nClass).then((response) => {
        console.log("update response: "+ JSON.stringify(response));
            
            if(response.data.val==2){ 
              this.init();
              // this.mdata = response.data.data;
            }else  if(response.data.val==3){ 
              //alert(response.data.message)
            }
            this.loading = false
    
  }).catch(function (response) {
            //handle error
            console.log("error"+JSON.stringify(response))
            
            this.loading = false
        });
      },
      reset () {
        this.$refs.form.reset()
      },
      resetValidation () {
        this.$refs.form.resetValidation()
      },
      admit(){
        let sdata=this.selected;
        let data1=[];
        sdata.forEach((item)=>{
          data1.push(item.id)
          // console.log(index, item.id)
        })
        const ids={
          ids:JSON.stringify(data1)
        }
         this.loading = true
      api.post('hod_u',ids).then((response) => {
        console.log("mdata: "+ JSON.stringify(response));
            
            if(response.data.val==2){ 
              this.mdata = response.data.data;
            }
            this.loading = false
    
  }).catch(function (response) {
            //handle error
            console.log("error"+JSON.stringify(response))
            
            this.loading = false
        });
    
      },
      handleClick(row) {
      console.log(row.fat)
    },
        fChange(){
          
        // console.log(this.fStudents)
        if(this.fStudents=="a"){
        this.init()
        this.fts="All"
        }else if(this.fStudents=="b"){
          this.students()
          this.fts="Students";
          // alert("b")
        }
      },
      init(){
        let context=this;
      this.loading = true
      api.get('kidato').then((response) => {
         console.log("mdata: "+ JSON.stringify(response.data.issued));
            
            if(response.data.val==2){ 
              this.mdata = response.data.data;
            }
            this.loading = false
    
  }).catch(function (response) {
            //handle error
            console.log("error"+JSON.stringify(response))
            context.loading = false
        });
    },
    kidato(row) {
      
        this.$store.commit('setId',row.id);
        this.$store.commit('setClass',row.name);
        this.$router.push('/class');
        console.log(row.id);
    },
     students(){
        this.loading = true;
        const context=this;
         
        api.get("students").then((response) => {
        console.log("switch response: "+ JSON.stringify(response.data));
            if(response.data.val==2){ 
           this.mdata = response.data.data;
            }
            this.loading = false
  }).catch(function (response) {
            console.log("error"+JSON.stringify(response))
            context.loading = false
        });
      },
    
      editItem (item) {
        // this.editedIndex = this.mdata.indexOf(item)
        // this.editedItem = Object.assign({}, item)
        this.mId=item.id;
        this.name=item.name;
        // this.eItem.push({name:item.name});
        // this.eItem.push({email:item.email});
        // alert("foo")
        console.log(this.eItem)
        this.sItem = true
          this.$router.push('/class');
          this.$store.commit('setId',item.id)
          this.$store.commit('setClass',item.name)
      },

      deleteItem (item) {
        console.log(item.id)
           this.loading = true
      api.delete('hod/'+item.id).then((response) => {
        console.log("mdata: "+ JSON.stringify(response.data.data));
            
            if(response.data.val==2){ 
              this.mdata = response.data.data;
            }
            this.loading = false
    
  }).catch(function (response) {
            //handle error
            console.log("error"+JSON.stringify(response))
            
            this.loading = false
        });
        // this.editedIndex = this.mdata.indexOf(item)
        // this.editedItem = Object.assign({}, item)
        // this.dialogDelete = true
      },

      deleteItemConfirm () {
        this.mdata.splice(this.editedIndex, 1)
        this.closeDelete()
      },

      close () {
        this.dialog = false
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        })
      },

      closeDelete () {
        this.dialogDelete = false
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        })
      },

      save () {
        if (this.editedIndex > -1) {
          Object.assign(this.mdata[this.editedIndex], this.editedItem)
        } else {
          this.mdata.push(this.editedItem)
        }
        this.close()
      },
    },
     mounted() {
      this.init()
     }
  }
</script>
<style lang="scss" scoped>

.loading-box{
     position: fixed;
    width: 100%;
    height: 5px;
    border-radius: 50px;
    /* border: 2px solid #ededed; */
    overflow: hidden;
    top: 38px;
    left: 0;
}
.loader{
    width: 100%;
    height: 100%;
    position: absolute;
    border-radius: 50px;
    background: linear-gradient(45deg, #3c0d0b,#b6b5ff, #ff9797,#3c0d0b);
    left: 0%;
    animation: load 1s linear infinite;
}


@keyframes load{
    0%{
        left: -100%;
    }
    100%{
        left: 100%;
    }
}
 
.selected {
    background-color: #fff;
    cursor:pointer;
}
</style>