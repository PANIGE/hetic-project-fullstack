import React , {useState}  from 'react'
import { NavLink} from 'react-router-dom'
import './login.css'


export default function Login() {


    const [email, setEmail] = useState('');
    const [password, setMdp] = useState('');

    const handleEmail = (e) => {

        setEmail(e.target.value);
        
    }
    
    const handleMpd = (e) => {

        setMdp(e.target.value);

    }

    function handleClick(e) {
        e.preventDefault();
            
            fetch('/api/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    email: {email},
                    password: {password},
                    })
        })
        .then((response) => {
            return response.json()
        })
    }

    return (
        <div className='form_login'>
            <form onSubmit={handleClick}>
                
                <div className='div_input'>
                    <input type="text" name="email"  value={email} onChange={handleEmail} id="email" required />
                    <span></span>
                    <label for="email">E-mail</label>
                </div>

                <div className='div_input'>
                    <input type="text" name="mdp"  value={password} onChange={handleMpd}  id="mdp" required />
                    <span></span>
                    <label for="mdp">Mot de passe</label>
                </div>
                
                <input type="submit" id="send" value="Se connecter"/>

                <NavLink to="/register/" 
                className={({isActive}) => { return isActive ? "sectionLink" : " "}}
            >Pas de compte ?</NavLink>

            </form>
        </div>
        
    )
    
    
}
