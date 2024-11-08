import { useState } from "react";
import Button from "@ui/button";
import ErrorText from "@ui/error-text";
import axios from "axios";
import { useForm } from "react-hook-form";
import { useRouter } from "next/router";
import { Link } from "react-scroll";

const OrdeForm = ({ className ,app }) => {
    const router = useRouter();
    const [appField,setAppField]=useState({  player_no:"",
        count:"",
        price:   app ? app.price : "",
        user_id: app ? app.id : "",
        app_id: app ? app.id : "",
        
      });
    const [player_no,setPlayerNo]=useState({
        player_no :"",
        
      });
      const [count,setCount]=useState(0);
      const [price,setPrice]=useState(app.price);
      const [app_id,setappId]=useState(app.id);


      const handleInputChange = (event) => {
        const { name, value } = event.target;

        setAppField((prev) => ({
          ...prev,  // الاحتفاظ بالقيم السابقة
          [name]: value,  // تحديث الحقل بناءً على قيمة الإدخال
           // مثال لتحديث price
       //   discount: name === "discount" ? value / 2 : prev.discount  // مثال لتحديث discount
         
    }));
           
        } 
             
     /*   if (name === 'count') {
            setAppField((prev) => ({
                ...prev,
                [name]: value,
                [price]: (value)*app.price,
            }));  
          
           
     
        } else {
            setAppField((prev) => ({
            ...prev, 
            [name]: value,           }));
        } console.log(count);
        console.log(price);
      };
*/
      const changeCountHandler = (e) => {
        setCount(e.target.value);
        console.log(count);
        setPrice((e.target.value)*app.price);
        console.log(price);

        
    };
    const changePlayerNoHandler = (e) => {
        const { name, value } = e.target;
        setPlayerNo((prev) => ({
            ...prev,
            [name]: value,
        }));

        console.log(player_no);
     

        
    };
  
    const csrf = () => axios.get('/sanctum/csrf-cookie');
    const onSubmit = async ( e) => {
    try{
      //  setAppField(player_no,count,price,"1",app.id);
        setAppField('app_id',app.id);
        setAppField('user_is',"1");
        setAppField('price',app.price);

          console.log(appField);

          e.preventDefault();
  const response=await axios.post(`http://localhost:8000/api/app/order/${app.id}`,appField,csrf);
   //   const response=await axios.post(`http://localhost:8000/api/myuser`,csrf);
       
     console.log(response.data);
       }
       catch(error){
        if (error.response) {
            // The request was made, and the server responded with a status code
            console.log('Error Data:', error.response.data);
            console.log('Error Status:', error.response.status);
            console.log('Error Headers:', error.response.headers);
       }}
      };
    return (
        <div className="form-wrapper-one registration-area">
           
            <form >
                <div className="tagcloud"> 
                <h3 className="mb--30"> اتمام عملية الشراء <Link path="#" className="mybutton-margin"> السعر :
                    {app.price}
                     </Link></h3>
                   
                </div>
                <div className="mb-5">
                    <label htmlFor="count" className="form-label">
                    </label>
                    <input
                       className="withRadius  myinput25"
                        type="number"
                        id="count"
                        name="count"
                        required=""
                        placeholder="  العدد"
                       defaultValue="0"
                        onChange={e=>handleInputChange(e)}
                     
                    />
                       <input
                       className="withRadius  myinput25 mybutton-margin"
                        type="number"
                        id="price"
                        name="price"
                        required=""
                        placeholder="  الاجمالي"
                        readOnly
                         value={appField.price}
                    
                     
                    />
                </div>

               <div className="mb-5">
                    <label htmlFor="player_no" className="form-label">
                    </label>
                    <input
                       className="withRadius"
                        type="text"
                        id="player_no"
                        name="player_no"
                        required=""
                   
                        placeholder=" معرف اللاعب"
                        onChange={e=>handleInputChange(e,'price')}
                     
                    />
                </div>


             
                <Button type="submit" size="medium" onClick={e=>onSubmit(e)}  className="mr--15">
                      شراء                   </Button>
                <Button path="/" color="primary-alta" size="medium">
                    الغاء الأمر 
                </Button>
            </form>
            <br>
            </br>
            <br>
            </br>
            <div>

            <p>{app.note}
            </p>
            </div>
        </div>
    );
};
export default OrdeForm;
