
function InputField({type,label,value}) {
  return (
    <div className="input">
      <p>{label}</p>
      <input type={type} value={value} />
    </div>
  );
}

export default InputField;