import React ,{Component} from 'react'
import { NavLink, Outlet } from 'react-router-dom'
import './style.css'

export default function Planing()  {
    
    const [data,setData]=useState([]);
    const getData=()=>{
        fetch('/api/report'
        ,{
        headers : { 
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        }
        }
        )
        .then(function(response){
            console.log(response)
            return response.json();
        })
        .then(function(myJson) {
            console.log(myJson);
            setData(myJson)
        });
    }
    useEffect(()=>{
        getData()
    },[])
        
    return (
        <div className='section'>

            <h1>Report</h1>
            
            <div id='allReport'>

                {data.map((post) => {
                    <NavLink to={post.id}>
                        <div className='card'>
                            <div className='cardTitle'>
                                <h4>{post.title} | by  </h4>
                                <p>{post.type}</p>
                            </div>
                            <div className='cardContent'>
                                <div>
                                    <p>{post.comment}</p>
                                    <div>
                                        <p>{post.dateStart}</p>
                                        <p>{post.dateEnd}</p>
                                    </div>
                                </div>
                                <div>
                                    <h4>{post.montant} €</h4>
                                </div> 
                            </div>
                        </div>
                    </NavLink>
                })}

            </div>

            <NavLink to="/report/Create" id='createBtn'
                className={({isActive}) => { return isActive ? "sectionLink" : "vueLink"}}
            >+</NavLink>
            
            <Outlet />
        </div>
    )
}