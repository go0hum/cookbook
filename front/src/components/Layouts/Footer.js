import { Link } from "react-router-dom";

export const Footer = () => {
  return (
    <footer className="bg-white shadow dark:bg-gray-800">
        <div className="p-4 mx-auto max-w-screen-xl md:flex md:items-center md:justify-between md:p-6">            
            <span className="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2023 <Link to="/" className="hover:underline">CookBook</Link>. All Rights Reserved.</span>
        </div>
    </footer>
  )
}
