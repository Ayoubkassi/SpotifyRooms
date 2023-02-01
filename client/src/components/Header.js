import logo from '../images/logo.svg';


function Header() {
    return (
      <div className="header">
        <div className="Logo">
            <img src={logo} />
        </div>
        <div className="navbar">
            <li>contact us</li>
            <li>discover</li>
            <li><a href='/login'>login</a></li>
        </div>
      </div>
    );
  }
  
  export default Header;