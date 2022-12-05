
<template>
  <v-app id="inspire">
    <v-app-bar
      app
      
      color="#3c0d0b"
      flat
    >
       <h4 class="text-white pt-3 mt-n5" style=" font-weight: 900;color: #ffffff;text-shadow: #cb6dff 1px 1px 2px;margin-top: 5px;margin-left: auto;margin-right: auto;" >{{sname}}</h4>
    </v-app-bar>
 <mdb-edge-header color="" style="background-color: #3c0d0b;margin-top:-12px;">
        <div class="home-page-background"></div>
           <div class="container">
              <div class="loading-box" v-if="loading">
                <div class="loader"></div>
              </div>
        <div class="row">
          <div class="col-lg-8 text-center mx-auto" style="margin-top:87px;position: fixed;left: 0;width:100%;">
          <h5 class="text-white pt-3 mt-n5" style=" font-weight: 900;color: #ffffff;margin-top: 5px;margin-left: 44px;margin-right: ;text-align: left;" >Class: {{sclass}}</h5>
          <h5 class="text-white pt-3 mt-n5" style=" font-weight: 900;color: #ffffff;margin-top: 5px;margin-left: 44px;margin-right: ;text-align: left;"  >Name: {{sname}}</h5>
        </div>
        </div>
           </div>
         
      </mdb-edge-header>
    <v-main class="grey lighten-3">
      <v-container>
        <mdb-btn style="color:#e9ecef;background: linear-gradient(315deg,#3f0d12,#a71d31 74%);box-shadow: rgb(38 3 3) 1px 5px 5px;" color="" type="submit" 
       @click="fBack"
      >{{sclass}}</mdb-btn>

        <v-expansion-panels focusable>
    <v-expansion-panel
      v-for="(item,i) in mKeys"
      :key="i"
    >
    <!-- <p>{{gb.item}}</p> -->
      <v-expansion-panel-header>{{item}}</v-expansion-panel-header>
      <v-expansion-panel-content>
    
     
      <v-text-field
        v-model="search"
        append-icon="mdi-magnify"
        label="Search"
        single-line
        hide-details
      ></v-text-field>
    <v-data-table
      :headers="headers"
      :items="gb[item]"
      :search="search"
      :items-per-page="itemsPerPage"
      :loading="loading"
      loading-text="Loading... Please wait"
      hide-default-footer

    ></v-data-table>
      </v-expansion-panel-content>
    </v-expansion-panel>
  </v-expansion-panels>

  <div id="app" class="container">
    <v-card style="margin-top:22px;padding:22px;max-width:1100px;margin:auto" >
      <v-form
    ref="form"
    v-model="valid"
    lazy-validation
  >
          <h1>Enter marks</h1>
          <div class="s">
            
            <div class="form-row">
            <div class="form-group col-md-3"  >
                <label>Year</label>
                <input v-model="mYear" :name="mYear" type="number" class="form-control" placeholder="0">
            </div>
            <div class="form-group col-md-3"  >
                <label>Term</label>
                <input v-model="mTerm" :name="mTerm" type="number" class="form-control" placeholder="1">
            </div>
            <div class="form-group col-md-3"  >
                <label>Mid</label>
                <input v-model="mMid" :name="mMid" type="number" class="form-control" placeholder="0">
            </div>
          </div>


            <div class="form-row">
              <div class="form-group col-md-3"  v-for="(subject, index) in subjects" :key="index">
                <label>{{subject.name}} {{Math.round((subject.score/subject.total)*100)}}%</label>
                <input v-model="subject.score" :name="`subjects[${index}][name]`" type="number" class="form-control" placeholder="0">/
                <input v-model="subject.total" :name="`subjects[${index}][name]`"  placeholder="100" type="number" class="form-control" >
              </div>
            
            </div>
          </div>


          <div class="form-group">
            <mdb-btn style="color:#e9ecef;background: linear-gradient(315deg,#3f0d12,#a71d31 74%);box-shadow: rgb(38 3 3) 1px 5px 5px;margin:auto" 
          @click="submit"
          >submit</mdb-btn>
          </div>
      </v-form>
    </v-card>
  </div>
         
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
  // import mForm from "./form.vue"
  import api from "../../services/api";
import {   mdbEdgeHeader, mdbBtn } from 'mdbvue';
  export default {
     components: {
      mdbEdgeHeader,
      mdbBtn
     },
     
    data: () => ({
      gb:"",
      page: 1,
      pageCount: 0,
      itemsPerPage: 5,
       search: '',
        headers: [
          {text: 'Name',value: 'name',},
          {text: 'Score',value: 'score',},
          {text: 'Total',value: 'total',},
          {text: '%',value: 'p',},
        ],
      mKeys:[],
      sname:"",
      sclass:"",
      mYear: new Date().getFullYear(),
      mTerm:1,
      mMid:0,
      subjects:[
      {
            "id": 3,
            "name": "English",
            "created_at": "2022-11-28 13:25:34",
            "updated_at": "2022-11-28 13:25:34",
            "cid": "20223"
        },
        {
            "id": 4,
            "name": "Geography",
            "created_at": "2022-11-28 13:26:02",
            "updated_at": "2022-11-28 13:26:02",
            "cid": "20223"
        },
      ],
      workExperiences: [
      {
        company: "Foxconn",
        title: "Engineer"
      },
      {
        company: "Cherri Tech",
        title: "Software Engineer"
      }
    ]
    }),
    
    computed: {
   
    },

    watch: {

    },

    
    methods:{ 
       fBack(){
       this.$router.push('/class');
    },
    //   addExperience () {
    //   this.workExperiences.push({
    //     company: '',
    //     title: ''
    //   })
    // },
groupBy(xs, key){
  return xs.reduce(function(rv, x) {
    (rv[x[key]] = rv[x[key]] || []).push(x);
    return rv;
  }, {});
},
    gMarks () {
      this.$refs.form.validate()
      let context=this;
        if(this.$store.state.sid==''){
           this.$router.push('/hod');
          console.log("sid: "+this.$store.state.sid)
        }
        const mdata={
          uid:this.$store.state.sid,
        }
        
        // console.log(JSON.stringify(data,null, 2))
        console.log("gMarks : "+ JSON.stringify(mdata,null, 2));
      this.loading = true;
      api.post('gMarks',mdata).then((response) => {
        console.log("subjects data: "+ JSON.stringify(response.data));
   
            if(response.data.val==2){ 

              let mResult = response.data.data;
              this.gb = this.groupBy(mResult, 'gb')
              // console.log("gb : "+ JSON.stringify(this.gb,null, 1));
              this.mKeys=Object.keys(this.gb);
              this.mKeys.forEach(el => {
                console.log("key : "+ JSON.stringify(el,null, 1));
                console.log("gb : "+ JSON.stringify(this.gb[el],null, 1));
              });
              // console.log(Object.keys(gb))
//               Object.keys(gb).forEach(function(category) {
//     console.log(`Team ${category} has ${gb[category].length} members : `);
//         gb[category].forEach(function(memb,i){
//         console.log(`---->${i+1}. ${memb.name}.`)
//     })
// });
            }
            this.loading = false
            
    
  }).catch(function (response) {
            //handle error
            console.log("error"+JSON.stringify(response))
            
            context.loading = false
        });
    },
    submit () {
      this.$refs.form.validate()
      let context=this;
        if(this.$store.state.sid==''){
           this.$router.push('/hod');
          console.log("sid: "+this.$store.state.sid)
        }
        const mdata={
          class_id:this.$store.state.mcid,
          uid:this.$store.state.sid,
          y:this.mYear,
          t:this.mTerm,
          mid:this.mMid,
          mSub:this.subjects,
        }
        // console.log(JSON.stringify(data,null, 2))
        // console.log("aMarks : "+ JSON.stringify(mdata,null, 2));
      this.loading = true
      api.post('aMarks',mdata).then((response) => {
        console.log("subjects data: "+ JSON.stringify(response.data));
   
            if(response.data.val==2){ 
              // this.mdata = response.data.data;
              // this.subjects=this.mdata;
              // this.fname= response.data.user[0].name;
           
              // this.fBalance= parseInt(this.fPending)-parseInt(this.fpayed);
              this. gMarks ();

            }
            this.loading = false
            
    
  }).catch(function (response) {
            //handle error
            console.log("error"+JSON.stringify(response))
            context.loading = false
        });
    },
    mSubjects(){
        let context=this;
        if(this.$store.state.mcid==''){
           this.$router.push('/hod');
        }
        const mdata={
          class_id:this.$store.state.mcid
        }
        this.sname=this.$store.state.sname;
        this.sclass=this.$store.state.kidato;
        console.log("mdata : "+ JSON.stringify(mdata));
      this.loading = true
      api.post('mSubjects',mdata).then((response) => {
        console.log("subjects data: "+ JSON.stringify(response.data));
   
            if(response.data.val==2){ 
              this.mdata = response.data.data;
              this.subjects=this.mdata;
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
    },
     mounted() {
      this.mSubjects();
      this.gMarks();
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
 
</style>