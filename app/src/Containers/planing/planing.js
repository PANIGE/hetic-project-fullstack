import React ,{Component} from 'react'
import { NavLink, Outlet } from 'react-router-dom'
import './style.css'


class planing extends Component {
    
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
            <div className='section'>

                <h1>Planing</h1>

                <div id='allPlaning'>
                    <div className='card'>
                        <div className='cardTitle'>
                            <h4>{this.state.post.title} | by  </h4>
                            <p>type</p>
                        </div>
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
                            </div> 
                        </div>
                    </div>
                </div>
                    
                <NavLink to="/planing/Create" id='createBtn'
                    className= {({isActive}) => { return isActive ? "sectionLink" : "vueLink"}}
                >+</NavLink>
                   
                <Outlet />
            </div>
        )
    }
}

export default planing
