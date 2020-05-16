import Admin from './components/AdminIndex.vue'
import Admins from './components/Admins.vue'
import Teachers from './components/Teachers.vue'
import Students from './components/Students.vue'
import Subjects from './components/Subjects.vue'
import Classrooms from './components/Classrooms.vue'
import Classlist from './components/Classlist.vue'
import Timetables from './components/Timetables.vue'
import Form from './components/Form.vue'
import MyClasses from './components/teacherpages/MyClasses.vue'
import Exams from './components/teacherpages/Exams.vue'
import TeacheSchedule from './components/teacherpages/MySchedule.vue'
import Term from './components/Terms.vue'
import formStream from './components/stream.vue'

export const routes = [
    {
        path:'/home',
        component: Admin,
    },
    {
        path:'/root-users',
        name: 'admins',
        component: Admins,
    },
    {
        path:'/teachers',
        name: 'allTeachers',
        component: Teachers
    },
    {
        path:'/students',
        name: 'allStudents',
        component: Students
    },
    {
        path:'/form',
        name: 'addForm',
        component: Form
    },
    {
        path:'/stream',
        name: 'addStream',
        component: formStream
    },
    {
        path:'/classes',
        name: 'addClass',
        component: Classrooms
    },
    {
        path:'/subjects',
        name: 'addSubject',
        component: Subjects
    },
    {
        path:'/timetables',
        name: 'timeTables',
        component: Timetables
    },
    {
        path:'/term',
        name: 'term',
        component: Term
    },

    {
        path:'/classlist/:id',
        name: 'classList',
        props:true,
        component: Classlist
    },
    {
        path:'/myclasses',
        name: 'myclasses',
        component: MyClasses
    }
    ,
    {
        path:'/exams',
        name: 'exams',
        component: Exams
    }
    ,
    {
        path:'/myschedule',
        name: 'myschedule',
        component: TeacheSchedule
    }

]
