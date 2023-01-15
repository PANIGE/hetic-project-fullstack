import React ,{useState , useNavigate} from 'react'
import { NavLink } from 'react-router-dom';

export default function Register() {

    const [email, setEmail] = useState('');
    const [password, setMdp] = useState('');
    const [lastname, setLastName] = useState('');
    const [firstname, setFirstName] = useState('');

    const handleEmail = (e) => {

        setEmail(e.target.value);
        
    }
    
    const handleMpd = (e) => {

        setMdp(e.target.value);

    }

    const handleLastName = (e) => {

        setLastName(e.target.value);

    }

    const handleFirstName = (e) => {

        setFirstName(e.target.value);
    
    }

    function handleClick(e) {
        e.preventDefault();
            
            fetch('/api/register', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    email: {email},
                    password: {password},
                    firstname: {firstname},
                    lastname: {lastname}
                    })
        })
        .then((response) => {
            return response.json()
        })

        handleNavigate();
    }

    function handleNavigate() {
        let navigate = useNavigate();

        try {
            navigate("/planing/"); // Omit optional second argument
        } catch (error) {
            navigate("/err", { state: { message: "Failed to submit form" } }); // Pass optional second argument
        }
    }

    return (
        <div className='form'>
            <form onSubmit={handleClick}>
                
                <div className='div_input'>
                    <input type="mail" name="email" value={email} onChange={handleEmail} id="email" required />
                    <span></span>
                    <label for="email">E-mail</label>
                </div>

                <div className='div_input'>
                    <input type="password" name="mdp" value={password} onChange={handleMpd}  id="mdp" required />
                    <span></span>
                    <label for="mdp">Mot de passe</label>
                </div>

                <div className='div_input'>
                    <input type="text" name="LastName" value={firstname} onChange={handleLastName}  id="LastName" required />
                    <span></span>
                    <label for="LastName">nom</label>
                </div>

                <div className='div_input'>
                    <input type="text" name="FirstName" value={lastname} onChange={handleFirstName}  id="FirstName" required />
                    <span></span>
                    <label for="FirstName">prenom</label>
                </div>
                
                <input type="submit" id="send" value="S'inscrire"/>

                <NavLink to="/login/" 
                className={({isActive}) => { return isActive ? "sectionLink" : " "}}
            >Déjà un compte ?</NavLink>

            </form>



        </div> 
        
    )
}
