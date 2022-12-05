
<template>
  
    <v-main class="grey lighten-3">
      <v-container>
       

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

     
      </v-container>
    </v-main>
</template>

<script>
  // import mForm from "./form.vue"
  import api from "../../services/api";
// import {    mdbBtn } from 'mdbvue';
  export default {
     components: {
      // mdbBtn
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
      // this.$refs.form.validate()
      let context=this;
        if(localStorage.getItem('user_id')==''){
           this.$router.push('/login');
          console.log("sid: "+localStorage.getItem('user_id'))
        }
        const mdata={
          uid:localStorage.getItem('user_id'),
        
        }
        // console.log(JSON.stringify(data,null, 2))
        // console.log("gMarks1 : "+ JSON.stringify(mdata,null, 2));
      this.loading = true
      api.post('gMarks1',mdata).then((response) => {
        // console.log("subjects data: "+ JSON.stringify(response.data));
   
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
   
    },
     mounted() {
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