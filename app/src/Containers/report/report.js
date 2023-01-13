import React ,{Component} from 'react'
import { NavLink, Outlet } from 'react-router-dom'

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
                    <h1>Planing {this.state.post.title}</h1>
                    <h1>Planing Commentaire</h1>
                    <h1>Planing date start</h1>
                    <h1>Planing date end</h1>
                    <ul>
                        <li>transactions</li>
                        <li>transactions</li>
                    </ul> 
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