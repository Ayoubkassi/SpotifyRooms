import side from '../images/side_pic.jpg';
import logo from '../images/logo.svg';
import spotify_logo from "../images/spotify.svg";
import InputField from './InputField';

function Login() {
  return (
    <div className="Login">
    	<div className="left">
    		<img src={side} alt="image" />
    	</div>

    	<div className="right">
    		<div className="logo">
    			<h2>Login</h2>
    			<img src={logo} />
    		</div>
    		<div className="spotify">
    			<img src={spotify_logo} />
    			<p>Connect with your spotify acount</p>
    		</div>
    		<div className="or">
    			--------------   OR   -------------
    		</div>
    		<div className="connect">
    		<div>
    		<InputField type="text" label="Username"/>
    		<InputField type="password" label="Password" />
    		</div>
    		<div>
    		<InputField type="submit" value="Connect" />
    		</div>
    		</div>
    		<div className="Terms">
    			By continuing you accept our <span>terms of use </span> & <span>privacy policy</span>
    		</div>
    	</div>
    </div>
  );
}

export default Login;