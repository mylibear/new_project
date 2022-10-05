import React, { useEffect, useState } from "react";
import styled from "styled-components";
import axios from "axios";
import { Buffer } from "buffer";
import loader from "../assets/koala-hi.gif";
import { ToastContainer, toast } from "react-toastify";
import "react-toastify/dist/ReactToastify.css";
import { useNavigate } from "react-router-dom";
import { setPetRoute } from "../utils/APIRoutes";
import cat from "../assets/cat.png";
import dog from "../assets/dog.png";
import koala from "../assets/koala.png";
import { FiArrowLeftCircle } from "react-icons/fi";




export default function SetPet() {

  const navigate = useNavigate();
  const [pets, setPets] = useState([]);
  const [pet, setPet] = useState([]);
  const [isLoading, setIsLoading] = useState(true);
  const [selectedPet, setSelectedPet] = useState(undefined);
  const toastOptions = {
    position: "bottom-right",
    autoClose: 8000,
    pauseOnHover: true,
    draggable: true,
    theme: "dark",
  };

  const baseAddr = './pets';

  const breeds = [1,2,3].map(value=> `${baseAddr}/${value}.png`);
  // const breed =["CAT","SHIBA IMU","KOALA"];

  useEffect(async () => {
    if (!localStorage.getItem(process.env.REACT_APP_LOCALHOST_KEY))
      navigate("/login");
  }, []);



  const setProfilePicture = async () => {
    if (selectedPet === undefined) {
      toast.error("Please select a pet", toastOptions);
    } else {
      const user = await JSON.parse(
        localStorage.getItem(process.env.REACT_APP_LOCALHOST_KEY)
      );

      const { data } = await axios.post(`${setPetRoute}/${user._id}`, {
        image: pets[selectedPet],
        name: pets[selectedPet],
      });

      if (data.isSet) {
        user.isPetImageSet = true;
        user.petImage = data.image;
        user.breed = data.breed;
        localStorage.setItem(
          process.env.REACT_APP_LOCALHOST_KEY,
          JSON.stringify(user)
        );
        navigate("/selectedpet");
      } else {
        toast.error("Error setting pet. Please try again.", toastOptions);
      }
    }
  };

  // const setPet =() => {
  //   if (selectedPet === undefined) {
  //     toast.error("Please select a pet", toastOptions);
  //   } else{
  //     navigate("/selectedPet");
  //   }
  
   
  // }

  const goBack = () => {
    console.log('hi')
    navigate("/setAvatar");
  };

  useEffect(()=>{
    setPets(breeds);
    setIsLoading(false)
  },[])

  const data = [
    {
      image: cat,
      breed: "CAT",
     
    },
    {
      image: dog,
      breed: "SHIBA IMU",
     
    },
    {
      image: koala,
      breed: "KOALA",
    },
   
  ];
  return (
    <>
     
        <Container>
          <div className="main">
         
          <div className="title">
          <button className="back" onClick={goBack}><FiArrowLeftCircle  color="white" fontSize="3em" /></button>
            <h1>
            Select a pet for your team
            </h1>
        </div>
          <div className="pets">
        {pets.map((pet,index) => {
          return (
            
            <div className="product">
            <div className="image">
                <div className={`pet ${
                    selectedPet === index ? "selected" : ""
                  }`}>
                   
                <img  src={breeds[index]} alt="" 
                // src={name[index]}
                key={pet}
                onClick={() => setSelectedPet(index)}
                />
                {/* <h2  key={pet}
                onClick={() => setSelectedPet(index)}>{pet.breed}</h2> */}
                </div>
              </div>
              </div>
            
 
          );
        })}
      </div>
         
          <button onClick={setProfilePicture} className="submit-btn">
            Continue
          </button>
          <div>
          </div>
          </div>
          <ToastContainer />
        </Container>
        
      
    </>
  );
}

const Container = styled.div`
  display: flex;
 justify-content: center;
  align-items: center;
  flex-direction: column;
  gap: 2rem;
  background-color: #ad6b16;
  height: 100vh;
  width: 100vw;
  text-align:center;
  color: #A1D9EB;



  .main{
    background-color: #A1D9EB;
    padding-left:10%;
    padding-right:10%;
    padding-top:1%;
    border-radius: 4.4rem;
    align-items: center;
    background-color: #A1D9EB;
    padding-left:10%;
    padding-right:10%;
    padding-top:10px;
    border-radius: 4.4rem;
    align-items: center;
    margin-top:2%;
    
  }
  .title{
    display: flex;
 justify-content: center;
  align-items: center;
  
  
  
  color: white;
  }
  .back{
    border: 0;
    margin-right:10px;
    height: 50px;
  width: 50px;
  background-color: #A1D9EB;
  
  
    
  }

  
  .submit-btn {
    background-color: #ad6b16;
    color: white;
    margin: 3rem 15rem;
    padding: 1rem 1rem;
    border: none;
    font-weight: bold;
    cursor: pointer;
    border-radius: 0.8rem;
    font-size: 1rem;

    text-transform: uppercase;
    &:hover {
      background-color: #85FFBD;
    }

  }

  .pets {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      margin-top: 5rem;
      gap: 3rem;
   

    .pet {
      border: 0.3rem solid transparent;
  
      border-radius: 3rem;
      transition: 0.5s ease-in-out;
      
    }
    .selected {
      border: 1rem solid #85FFBD;
    }

    .product {
          .image {
            max-height: 50rem;
            overflow: hidden;
            border-radius: 1rem;
            img {
              height: 22rem;
              width: 14rem;
              object-fit: cover;
              border-radius: 2rem;
          
            }
          }
         
          }
  }



  @media screen and (min-width: 280px) and (max-width: 720px) {
    .pets {
      grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    }
  }
  @media screen and (min-width: 720px) and (max-width: 1080px) {
    .pets {
      grid-template-columns: repeat(2, 1fr);
    }
  }

  @media screen and (min-width: 260px) and (max-width: 1080px) {
    .title {
      gap: 1rem;
      h1 {
        font-size: 2rem;
      }
      p {
        padding: 0 1vw;
      }
    }
  }
`;


