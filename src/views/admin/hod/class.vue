
<template>
  <v-app id="inspire">
    <v-app-bar
      app
      
      color="#3c0d0b"
      flat
    >
       <h4 class="text-white pt-3 mt-n5" style=" font-weight: 900;color: #ffffff;text-shadow: #cb6dff 1px 1px 2px;margin-top: 5px;margin-left: auto;margin-right: auto;" >{{fname}}</h4>
    </v-app-bar>
 <mdb-edge-header color="" style="background-color: #3c0d0b;margin-top:-12px;">
        <div class="home-page-background"></div>
           <div class="container">
              <div class="loading-box" v-if="loading">
                <div class="loader"></div>
              </div>
        <div class="row">
          <div class="col-lg-8 text-center mx-auto" style="margin-top:87px;position: fixed;left: 0;width:100%;">
          <h5 class="text-white pt-3 mt-n5" style=" font-weight: 900;color: #ffffff;margin-top: 5px;margin-left: 44px;margin-right: ;text-align: left;" >CLass: {{fclass}}</h5>
          <!-- <h5 class="text-white pt-3 mt-n5" style=" font-weight: 900;color: #ffffff;margin-top: 5px;margin-left: 44px;margin-right: ;text-align: left;"  >email: {{femail}}</h5> -->
        </div>
        </div>
           </div>
         
      </mdb-edge-header>
    <v-main class="grey lighten-3">
      <v-container>
     
            <v-sheet
              min-height="70vh"
              rounded="lg"
            >

            

  <v-card style="margin-top:-122px" >
   
    <v-card-title>
      <mdb-btn style="color:#e9ecef;background: linear-gradient(315deg,#3f0d12,#a71d31 74%);box-shadow: rgb(38 3 3) 1px 5px 5px;" color="" type="submit" 
       @click="fBack"
      >All Classes</mdb-btn>
      <v-spacer></v-spacer>
      <v-switch
      v-model="switch1"
      :label="tswitch"
       @change="srt"
    ></v-switch>
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
    v-model="selected"
    show-select
      :headers="headers"
      :items="mdata"
      :search="search"
      :page.sync="page"
      :items-per-page="itemsPerPage"
      :loading="loading"
      loading-text="Loading... Please wait"
      hide-default-footer
      v-if="!subjectsd"
      class="selected"
      @page-count="pageCount = $event"
      @click:row="gStudent"

    >
    <template v-slot:top>
      <v-toolbar
        flat
      >
      <a-radio-group v-model="fStudents" @change="fChange" size="small">
        <a-radio-button checked="fchecked" value="1">Admitted</a-radio-button>
        <a-radio-button value="b">All</a-radio-button>
        <!-- <a-radio-button value="d">Chengdu</a-radio-button> -->
      </a-radio-group>
        <!-- <v-toolbar-title>My CRUD</v-toolbar-title> -->
        <!-- <v-divider
          class="mx-4"
          inset
          vertical
        ></v-divider>
        <v-spacer></v-spacer>
        <v-card-title>
      {{fts}} students
      <v-spacer></v-spacer>
    </v-card-title> -->
     <v-divider
          class="mx-3"
          inset
          vertical
        ></v-divider>
        <v-spacer></v-spacer>
    <!-- <v-btn v-if="fall"
              color="primary"
              dark
              class="mb-2"
               v-bind="attrs"
              v-on="on"
              @click="addStudents"
              style="color:#e9ecef;background: linear-gradient(315deg,#3f0d12,#a71d31 74%);box-shadow: rgb(38 3 3) 1px 5px 5px;"
            >
              Add students
            </v-btn> -->

          <mdb-btn style="color:#e9ecef;background: linear-gradient(315deg,#3f0d12,#a71d31 74%);box-shadow: rgb(38 3 3) 1px 5px 5px;" color="" type="submit" 
          @click="addStudents"
          v-if="fall"
      >Add students</mdb-btn>
        <!-- <v-btn v-if="!fall"
              color="primary"
              dark
              class="mb-2"
               v-bind="attrs"
              v-on="on"
              @click="removeStudents"
              style="color:#e9ecef;background: linear-gradient(315deg,#3f0d12,#a71d31 74%);box-shadow: rgb(38 3 3) 1px 5px 5px;"
            >
              Promote students
            </v-btn> -->
            
          <mdb-btn style="color:#e9ecef;background: linear-gradient(315deg,#3f0d12,#a71d31 74%);box-shadow: rgb(38 3 3) 1px 5px 5px;" color="" type="submit" 
          @click="removeStudents"
          v-if="!fall"
      >Promote students</mdb-btn>
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
   
    <v-data-table
    v-model="selected"
    show-select
      :headers="headers"
      :items="mdata"
      :search="search"
      :page.sync="page"
      :items-per-page="itemsPerPage"
      :loading="loading"
      loading-text="Loading... Please wait"
      hide-default-footer
      v-if="subjectsd"
      class="selected"
      @page-count="pageCount = $event"
      @click:row="handleClick"

    >
    <template v-slot:top>
      <v-toolbar
        flat
      >
      <a-radio-group v-model="fSubjects" @change="sChange" size="small">
        <a-radio-button checked="fchecked" value="1">class Subjects</a-radio-button>
        <a-radio-button value="b">All</a-radio-button>
        <!-- <a-radio-button value="d">Chengdu</a-radio-button> -->
      </a-radio-group>
        <!-- <v-toolbar-title>My CRUD</v-toolbar-title> -->
        <v-divider
          class="mx-4"
          inset
          vertical
        ></v-divider>
        <!-- <v-spacer></v-spacer>
        <v-card-title>
      {{sts}} subjects
      <v-spacer></v-spacer>
    </v-card-title> -->
    <!-- <v-divider
          class="mx-4"
          inset
          vertical
        ></v-divider> -->
        <v-spacer></v-spacer>
    <!-- <v-btn v-if="sall"
              color="primary"
              dark
              class="mb-2"
               v-bind="attrs"
              v-on="on"
              @click="aSubjects"
              style="color:#e9ecef;background: linear-gradient(315deg,#3f0d12,#a71d31 74%);box-shadow: rgb(38 3 3) 1px 5px 5px;"
            >
              Add subjects
            </v-btn> -->
            <mdb-btn style="color:#e9ecef;background: linear-gradient(315deg,#3f0d12,#a71d31 74%);box-shadow: rgb(38 3 3) 1px 5px 5px;" color="" type="submit" 
          @click="aSubjects"
          v-if="sall"
      >Add subjects</mdb-btn>

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
       <div class="loading-box" v-if="loading1">
                <div class="loader"></div>
              </div>
      <v-card style="max-width:800px; margin-left:auto;margin-right:auto;margin-top:22px;padding:22px" v-if="sItem==true">
    <v-card-title>
      Add student
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
  
      label="Name"
     
    ></v-text-field>

    <v-text-field
      v-model="value"
      :rules="valueRules"
      label="Value"
      required
    ></v-text-field>

      <v-select
      v-model="status"
      :items="items"
      :rules="[v => !!v || 'status is required']"
      label="status"
      required
    ></v-select>

    <v-btn
      :disabled="!valid"
      color="success"
      class="mr-4"
      @click="validate"
    >
      update
    </v-btn>
 <v-btn
      color="warning"
      @click="sClose"
    >
      close
    </v-btn>

  </v-form>
   </v-card>
   <v-card style="max-width:800px; margin-left:auto;margin-right:auto;margin-top:22px;padding:22px" >
    <v-card-title>
      Add Subject
      <v-spacer></v-spacer>
      </v-card-title>
  
  
  <v-form
    ref="form"
    v-model="valid"
    lazy-validation
  >

    <v-text-field
      v-model="sname"
      :counter="10"
      :rules="nameRules"
      label="Name"
      required
    ></v-text-field>

    <v-btn
      :disabled="!valid"
      color="success"
      class="mr-4"
      @click="addSubject"
    >
      Add
    </v-btn>


  </v-form>
   </v-card>
  </v-card>
  
  <!-- <mForm :eItem="eItem" v-if="sItem==true"/> -->
 
   
              <!--  -->
            </v-sheet>
         
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
  // import mForm from "./form.vue"
  import api from "../../services/api";
import {   mdbEdgeHeader,mdbBtn  } from 'mdbvue';
  export default {
     components: {
      mdbEdgeHeader,
      mdbBtn
     },
     
    data: () => ({
      
      switch1:true,
      tswitch:"Students",
      switch2:"Not cleared",
      fPending:0,
      fPayed:0,
      fBalance:0,
      fStudents:"a",
      fchecked:true,
      fname:"",
      fcode:"",
      fclass:"",
      femail:"",
      loading1:true,
      valid: true,
      name: '',
      nameRules: [
        v => !!v || 'Name is required',
        v => (v && v.length > 2) || 'Enter valid name',
      ],
      value: 0,
    
      status: null,
      items: [
        'pending',
        'payed',
      ],
      mId:'',
      selected: [],
      eItem:[],
      sItem:false,
      subjectsd:false,
      sname:"",
      fts:"Admitted",
      sts:"Class",
      fSubjects:"",
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
          
          //  { text: 'Actions', value: 'actions1', sortable: false },
          {
            text: 'Name',
            sortable: false,
            value: 'name',
          },
          // { text: 'Role', value: 'role' },
          // { text: 'Value', value: 'value' },
          { text: 'Code ', value: 'code' },
          // { text: 'admission ', value: 'admission' },
          //  { text: 'Actions', value: 'actions', sortable: false },
          // { text: 'Iron (%)', value: 'iron' },
        ],
        mdata: [
          {
            name: 'loading',
            role: 'loading',
            email: 'loading',
            code: 'loading',
          },
        ],
        loading:true,
        dialog: false,
      dialogDelete: false,
      // desserts: [],
      editedIndex: -1,
      addedItem: {
        name: '',
        value: 0,
      },
       editedItem: {
     
      },
      fall:false,
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
      gStudent(row) {
      
      this.$store.commit('setSid',row.id);
      this.$store.commit('setSname',row.name);
      this.$router.push('/student');
      console.log(row.id);
  },
      fChange(){
        // alert(this.fStudents)
        // console.log(this.fStudents)
        if(this.fStudents==1){
          this.fall=false;
          this.init();
          this.fts="Admitted";
        // alert("foo")
        }else if(this.fStudents=="b"){
      

          this.students()
        this.fts="All"
        this.fall=true;
         
          // alert("b")
        }
      },
      
      sChange(){
        // alert(this.fStudents)
        // console.log(this.fStudents)
        if(this.fSubjects==1){
          this.sall=false;
          this.mSubjects();
          this.sts="Class";
        // alert("foo")
        }else if(this.fSubjects=="b"){
      
          this.showSubjects()
        this.sts="All"
        this.sall=true;
         
          // alert("b")
        }
      },
        srt(){
          if(this.switch1){
            this.tswitch="students"
            this.init()
            this.subjectsd=false;
          }else{
            this.tswitch="subjects"
            this.mSubjects()
            this.subjectsd=true;
          }
        },
       mSubjects(){
        let context=this;
        if(this.$store.state.mcid==''){
           this.$router.push('/hod');
        }
        const mdata={
          class_id:this.$store.state.mcid
        }
      this.loading = true
      api.post('mSubjects',mdata).then((response) => {
        console.log("subjects data: "+ JSON.stringify(response.data));
   
            if(response.data.val==2){ 
              this.mdata = response.data.data;
              // this.fname= response.data.user[0].name;
           
              // this.fBalance= parseInt(this.fPending)-parseInt(this.fpayed);
            }
            this.loading = false
            
    
  }).catch(function (response) {
            //handle error
            console.log("error"+JSON.stringify(response))
            
            context.loading = false
        });
       },

       showSubjects(){
        let context=this;
        if(this.$store.state.mcid==''){
           this.$router.push('/hod');
        }
      
      this.loading = true
      api.get('showSubjects').then((response) => {
        console.log("subjects data: "+ JSON.stringify(response.data));
   
            if(response.data.val==2){ 
              this.mdata = response.data.data;
              // this.fname= response.data.user[0].name;
           
              // this.fBalance= parseInt(this.fPending)-parseInt(this.fpayed);
            }
            this.loading = false
            
    
  }).catch(function (response) {
            //handle error
            console.log("error"+JSON.stringify(response))
            
            context.loading = false
        });
       },
      
      sClose(){
        this.sItem=false;
      },
      addSubject () {
        this.$refs.form.validate()
        const mData={
        // mcid:this.$store.state.mcid,
        name:this.sname,
      }
      this.loading = true;

      console.log("mData: "+ JSON.stringify(mData));
        api.post("addSubject",mData).then((response) => {
        console.log("update response: "+ JSON.stringify(response));
            
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
    fBack(){
       this.$router.push('/hod');
    },
    
    aSubjects(){
      let context=this;
        if(this.$store.state.mcid==''||this.$store.state.mcid==undefined){
           this.$router.push('/hod');
        }
        let d= this.selected;
        let cid=[]
        d.forEach(d1 => {
        cid.push(d1.id)
        });
        const mdata={
          selected:cid,
          class_id:this.$store.state.mcid
        }
        console.log("mdata: "+ JSON.stringify(mdata));
      this.loading = true
      api.post('aSubjects',mdata).then((response) => {
        console.log("data: "+ JSON.stringify(response.data));
   
            
            if(response.data.val==2){ 
              // this.mdata = response.data.data;
              // this.fname= response.data.user[0].name;
           
              // this.fBalance= parseInt(this.fPending)-parseInt(this.fpayed);
              this.fSubjects=1;
              this.sChange();
            }
            this.loading = false
            
    
  }).catch(function (response) {
            //handle error
            console.log("error"+JSON.stringify(response))
            
            context.loading = false
        });
    },
    addSelected(d){
        if(this.$store.state.mcid==''||this.$store.state.mcid==undefined){
           this.$router.push('/hod');
        }
        let cid=[]
        d.forEach(d1 => {
        cid.push(d1.id)
        });
        const mdata={
          selected:cid,
          class_id:this.$store.state.mcid
        }
        console.log("mdata: "+ JSON.stringify(mdata));
      this.loading = true
      api.post('admiting',mdata).then((response) => {
        console.log("data: "+ JSON.stringify(response.data));
   
            
            if(response.data.val==2){ 
              this.mdata = response.data.data;
              // this.fname= response.data.user[0].name;
           
              // this.fBalance= parseInt(this.fPending)-parseInt(this.fpayed);
            }
            this.loading = false
            
    
  }).catch(function (response) {
            //handle error
            console.log("error"+JSON.stringify(response))
            
            this.loading = false
        });
    },
   init(){
        if(this.$store.state.mcid==''){
           this.$router.push('/hod');
        }
        this.fclass=this.$store.state.kidato;
        const mdata={
          class_id:this.$store.state.mcid
        }
      this.loading = true
      api.post('admited',mdata).then((response) => {
        console.log("finance data: "+ JSON.stringify(response.data));
   
            
            if(response.data.val==2){ 
              this.mdata = response.data.data;
              // this.fname= response.data.user[0].name;
           
              // this.fBalance= parseInt(this.fPending)-parseInt(this.fpayed);
            }
            this.loading = false
            
    
  }).catch(function (response) {
            //handle error
            console.log("error"+JSON.stringify(response))
            
            this.loading = false
        });
    },
    students(){
   
        this.fclass=this.$store.state.kidato;
       
      this.loading = true
      api.get('students').then((response) => {
        console.log("finance data: "+ JSON.stringify(response.data));
   
            
            if(response.data.val==2){ 
              this.mdata = response.data.data;
              // this.fname= response.data.user[0].name;
           
              // this.fBalance= parseInt(this.fPending)-parseInt(this.fpayed);
            }
            this.loading = false
            
    
  }).catch(function (response) {
            //handle error
            console.log("error"+JSON.stringify(response))
            
            this.loading = false
        });
    },
    
    addStudents(){
      // this.$router.push('/students');
     this.addSelected(this.selected)
      console.log(this.selected)
    },
    
      editItem (item) {
        // this.editedIndex = this.mdata.indexOf(item)
        // this.editedItem = Object.assign({}, item)
        this.mId=item.id;
        this.name=item.name;
        this.status=item.status;
        this.value=item.value;
        // this.eItem.push({name:item.name});
        // this.eItem.push({email:item.email});
        console.log(this.eItem)
        this.sItem = true
      },

      deleteItem (item) {
        console.log(item.id)
           this.loading = true
           const mData={
            id:item.id,
            sid:this.$store.state.id,
           }
      api.post('finance_del',mData).then((response) => {
        console.log("mdata: "+ JSON.stringify(response.data));
            
            if(response.data.val==2){ 
              this.mdata = response.data.data;
              this.fPending=response.data.pending;
              this.fPayed=response.data.payed;
              this.fBalance= parseInt(this.fPending)-parseInt(this.fPayed);
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
        // this.$nextTick(() => {
        //   this.editedItem = Object.assign({}, this.defaultItem)
        //   this.editedIndex = -1
        // })
      },

      closeDelete () {
        this.dialogDelete = false
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        })
      },

      save () {
        // if (this.editedIndex > -1) {
        //   Object.assign(this.mdata[this.editedIndex], this.editedItem)
        // } else {
        //   this.mdata.push(this.editedItem)
        // }
        this.close()
        this.loading = true;
           console.log(this.fStudents);
        let mgo="pending"
        if(this.fStudents=="b"){
          mgo="payed"
        }
        const mData={
          sid:this.$store.state.id,
          name:this.addedItem.name,
          value:this.addedItem.value,
          status:mgo,
        }
     
         mgo="payment"
        api.post(mgo,mData).then((response) => {
        console.log("update response: "+ JSON.stringify(response));
            
            if(response.data.val==2){ 
              this.mdata = response.data.data;
               this.fPending=response.data.pending;
              this.fPayed=response.data.payed;
              this.fBalance= parseInt(this.fPending)-parseInt(this.fPayed);
            }
            this.loading = false
    
  }).catch(function (response) {
            //handle error
            console.log("error"+JSON.stringify(response))
            
            this.loading = false
        });
      
        // console.log(this.addedItem)
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