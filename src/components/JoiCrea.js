import Header from './Header';
import Left from './Left';
import Right from './Right';

function JoiCrea() {
    return (
      <div className="joincreate">
        <Header />
        <div className="lef-ri">
            <Left />
            <Right />
        </div>
      </div>
    );
  }
  
export default JoiCrea;