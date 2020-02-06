// var login = new Vue({
//     el: '#login_main_app',
//     data: {
//       message: 'Hello Vue!',
//       user_id: '',
//       password: '',
//       user_id_error: '',
//       password_error: '',
//       error:false
//     },
//     methods: {
//       clickLogin: function (event) {

//         this.error = false
//         // ユーザーID
//         if(!this.user_id){
//           this.user_id_error = 'Emailを入力してください'
//           this.error = true
//         }else{
//           this.user_id_error = ''
//         }
//         // パスワード
//         if(!this.password){
//           this.password_error = 'Passwordを入力してください'
//           this.error = true
//         }else{
//           this.password_error = ''
//         }
//         // エラーの有無
//         if(!this.error){
//           console.log(this.user_id);
//           console.log(this.password);
//         }
//       }
//     }
//   })