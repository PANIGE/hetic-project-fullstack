import React ,{Component} from 'react'
import { NavLink, Outlet } from 'react-router-dom'
import './style.css'

class report extends Component {
    
    state = {
        post: {}
    }

    componentDidMount() {

        fetch('http://jsonplaceholder.typicode.com/todos/1')
        .then((response) => {
            return response.json()
        })
        .then((result) => {
            this.setState({post: result})
        })

    }

    render() {
        return (
            <div>
                
                <div id='allPlaning'>
                    <div className='card'>
                        <h4>{this.state.post.title} | by  </h4>
                        <div className='cardContent'>
                            <div>
                                <p>Planing Commentaire</p>
                                <div>
                                    <p>date start</p>
                                    <p>date end</p>
                                </div>
                            </div>
                            <div>
                                <h4>transation €</h4>
                                <p>type</p>
                            </div> 
                        </div>
                    </div>
                </div>

                <ul>

                    <NavLink to="/report" 
                        className={({isActive}) => { return isActive ? "activeLink" : ""}}
                    >search</NavLink>
                    
                    <NavLink to="/report/Create" 
                        className={({isActive}) => { return isActive ? "activeLink" : ""}}
                    ><button className="createBtn">Create</button></NavLink>
                
                </ul>
                <Outlet />
            </div>
        )
    }
}

export default report