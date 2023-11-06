import { useTitle } from "../../hooks/useTitle";
import { Hero } from "./components/Hero";

export const HomePage = () => {
  useTitle("Access Latest Computer Science eBooks");

  return (
    <main>
        <Hero />
    </main>
  )
}
