import Admin from './components/AdminIndex.vue'
import Admins from './components/Admins.vue'
import Teachers from './components/Teachers.vue'
import Students from './components/Students.vue'
import MyTimetable from './components/student/MyTimetable'
import ExamResults from './components/student/Results'
import MyProfile from './components/student/Account'
import Notes from './components/student/Notes'
import PastPapers from './components/student/PastPapers'
import Subjects from './components/Subjects.vue'
import Classrooms from './components/Classrooms.vue'
import Classlist from './components/Classlist.vue'
import Timetables from './components/Timetables.vue'
import Form from './components/Form.vue'
import MyClasses from './components/teacherpages/MyClasses.vue'
import Exams from './components/teacherpages/Exams.vue'
import Marks from './components/teacherpages/Marks.vue'
import Term from './components/Terms.vue'
import formStream from './components/stream.vue'
import NotFoundPage from './components/NotFoundPage'
import AddRevisionMaterials from "./components/AddRevisionMaterials";
import MailBox from "./components/MailBox";
import TeacherProfile from "./components/teacherpages/TeacherProfile";
import NewsCenter from "./components/NewsCenter";
import SinglePost from "./components/SinglePost";


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
        component: Teachers,
    },
    {
        path:'/students',
        name: 'allStudents',
        component: Students,
    },
    {
        path:'/mytimetable',
        name: 'myTimetable',
        component: MyTimetable,
    },
    {
        path:'/student-profile',
        name: 'myProfile',
        component: MyProfile,
    },
    {
        path:'/mailbox',
        name: 'mailbox',
        component: MailBox,
    },
    {
        path:'/notes',
        name: 'notes',
        component: Notes
    },
    {
        path:'/pastpapers',
        name: 'pastPapers',
        component: PastPapers
    },

    {
        path:'/revision-materials',
        name: 'revisionMaterials',
        component: AddRevisionMaterials
    },
    {
        path:'/results',
        name: 'myResults',
        component: ExamResults,
    },
    {
        path:'/form',
        name: 'addForm',
        component: Form,
    },
    {
        path:'/stream',
        name: 'addStream',
        component: formStream,
    },
    {
        path:'/classes',
        name: 'addClass',
        component: Classrooms,
    },
    {
        path:'/subjects',
        name: 'addSubject',
        component: Subjects,
    },
    {
        path:'/timetables',
        name: 'timeTables',
        component: Timetables,
    },
    {
        path:'/term',
        name: 'term',
        component: Term,
    },

    {
        path:'/classlist/:id',
        name: 'classList',
        props:true,
        component: Classlist,
    },
    {
        path:'/myclasses',
        name: 'myclasses',
        component: MyClasses,
    }
    ,{
        path:'/teacher-profile',
        name: 'teacherProfile',
        component: TeacherProfile,
    }
    ,
    {
        path:'/exams',
        name: 'exams',
        component: Exams,
    }
    , {
        path:'/news-center',
        name: 'newsCenter',
        component: NewsCenter,
    }
    ,
    {
        path:'/:postTitle/:id',
        name: 'singlepost',
        props: true,
        component: SinglePost,
    }
    ,{
        path:'/marks/:classid/:timetableid',
        name: 'marks',
        props: true,
        component: Marks,
    }
    ,
    {
        path:'*',
        name: 'NotFound',
        component: NotFoundPage
    }

]
