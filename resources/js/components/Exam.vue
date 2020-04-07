<template>
    <div >
      <h1>Kichu Nai</h1>

    </div>
</template>
<script>
    import Navbar from './Navbar';
    export default {
        name: 'Exam',
        components: {
            Navbar
        },
        data() {
            return {
                loggedIn: true,
                exams : [],
                student : {}
            }
        },
        mounted() {
            // console.log('this is exam page');
            // get all exams
            axios.get('get_all_exams')
            .then((res)=>{
                this.exams = res.data.exam;
                // console.log(res.data.exam);
            });
        },
        created() {
            axios.get('check_user_session')
                .then((res) => {
                    // if (res.data > 0) {
                        if (res.data.phone == 0) {
                            this.loggedIn = false;
                        } else {
                            this.loggedIn = true;
                            this.student = res.data.student
                        }
                    // }
                    console.log(res.data.student);
                });
        },
    }

</script>
<style lang="" scope>
    
</style>
