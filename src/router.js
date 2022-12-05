import Vue from 'vue'
import Router from 'vue-router'
// import Home from './views/Home.vue'
// import Results from './views/Results.vue'
import Init from './views/init.vue'
// import Main from './views/mainContent.vue'
import Admin from './views/admin/login.vue'
import Signup from './views/admin/signup.vue'
import Lib from './views/admin/lib/main.vue'
import Libf from './views/admin/lib/form.vue'
import Finance from './views/admin/finance/main.vue'
import Financef from './views/admin/finance/form.vue'
import Gown from './views/admin/gown/main.vue'
import Gownf from './views/admin/gown/form.vue'
import Rec from './views/admin/rec/main.vue'
// import Products from './views/admin/products.vue'


import Hod from './views/admin/hod/hod.vue'
import Class from './views/admin/hod/class.vue'
// import Students from './views/admin/hod/students.vue'
import Subjects from './views/admin/hod/subjects.vue'
import Student from './views/admin/hod/student.vue'
import mStudent from './views/admin/student/main.vue'


Vue.use(Router)
const isLoggedIn=(to,from,next)=>{
  
  if(localStorage.getItem('access_token')){
    // console.log("Logged in")
    next()
  }else{
    // return false
    // next()
    return '/Admin'
    // return { name: '/admin' }
    // from();
  }
  
}
export default new Router({
  routes: [

    
    {
      path: '/hod',
      name: 'Hod',
      component: Hod,
      beforeEnter:isLoggedIn
    },
    
    {
      path: '/class',
      name: 'Class',
      component: Class,
      beforeEnter:isLoggedIn
    },
    // {
    //   path: '/students',
    //   name: 'Students',
    //   component: Students,
    //   beforeEnter:isLoggedIn
    // },
    {
      path: '/subjects',
      name: 'Subjects',
      component: Subjects,
      beforeEnter:isLoggedIn
    },
    {
      path: '/student',
      name: 'Student',
      component: Student,
      beforeEnter:isLoggedIn
    },
    {
      path: '/mstudent',
      name: 'mStudent',
      component: mStudent,
      beforeEnter:isLoggedIn
    },
    
    {
      path: '/',
      name: 'Init',
      component: Init
    },
  
    {
      path: '/admin',
      name: 'Admin',
      component: Admin
    },
    {
      path: '/signup',
      name: 'Signup',
      component: Signup
    },
   
    {
      path: '/lib',
      name: 'Lib',
      component: Lib,
      beforeEnter:isLoggedIn
    },
    {
      path: '/libf',
      name: 'Libf',
      component: Libf,
      beforeEnter:isLoggedIn
    },
    {
      path: '/finance',
      name: 'Finance',
      component: Finance,
      beforeEnter:isLoggedIn
    },
    {
      path: '/financef',
      name: 'Financef',
      component: Financef,
      beforeEnter:isLoggedIn
    },
    {
      path: '/gown',
      name: 'Gown',
      component: Gown,
      beforeEnter:isLoggedIn
    },
    {
      path: '/gownf',
      name: 'Gownf',
      component: Gownf,
      beforeEnter:isLoggedIn
    },
    {
      path: '/student',
      name: 'Student',
      component: Student,
      beforeEnter:isLoggedIn
    },
    {
      path: '/rec',
      name: 'Rec',
      component: Rec,
      beforeEnter:isLoggedIn
    },
    
    
    
    
   
  ]
})
