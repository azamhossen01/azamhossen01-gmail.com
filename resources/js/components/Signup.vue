<template>
    <div v-if="loggedIn == false">
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                    <h2 class="form-title">Provide Your Information </h2>
                    <form class="register-form" id="register-form" >
                           
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input v-model="name" type="text" required name="name" id="name" placeholder="Your Name"/>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input v-model="email" type="email" name="email" id="email" placeholder="Your Email (Optional)"/>
                            </div>
                            <div class="form-group">
                                <label for="phone"><i class="zmdi zmdi-lock"></i></label>
                                <input v-model="phone" type="number" name="phone" id="phone" placeholder="**Phone Number**" required/>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" @click.prevent="student_register" name="signup" id="signup" class="form-submit" value="Submit"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img :src="'frontend/images/signup-image.jpg'" alt="sing up image"></figure>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>
<script>
export default {
    name : 'Signup',
    data(){
        return {
            name : "",
            email : "",
            phone : "",
            loggedIn : false
        }
    },
    mounted(){
        console.log('this is sign up page');
        
    },
    created(){
        axios.get('check_user_session')
        .then((res) => {
           
            if(res.data == 0){
                this.loggedIn = false;
            }else{
               this.loggedIn = true;
               this.$router.replace('/exam');
            }
            
            console.log(res.data);
        });
    },
    methods : {
        student_register(){
            axios.post('student_register',{
                name : this.name,email : this.email, phone : this.phone
            })
            .then((res)=>{
                this.$router.replace('/exam');
            });
        }
    }
}
</script>