import PokemonInfoStatTable from "../../../components/ui/PokemonInfo/PokemonInfoStatTable";
import PokemonInfoTable from "../../../components/ui/PokemonInfo/PokemonInfoTable";
import { PokemonMoveList } from "../../../components/ui/PokemonMove/PokemonMoveList";
import PokemonSelector from "../../../components/ui/PokemonSelector/PokemonSelector";
import { Pokemon } from "../../../types/interfaces/backend/pokemon/Pokemon";

interface Props {
    pokemon: Pokemon
}

export default async function PokemonInfoSection({ pokemon }: Props) {

    return (
        <section className="w-full flex flex-col items-center">
            <PokemonSelector pokemon={pokemon} className="mb-7" />
            <PokemonInfoTable pokemon={pokemon} className="w-[82.5%] rounded-xl overflow-hidden" />
            <PokemonInfoStatTable pokemon={pokemon} className="w-[82.5%] rounded-xl mt-4 overflow-hidden" />
            <PokemonMoveList moves={pokemon.moves} className="w-[82.5%] mt-4" />
        </section>
    );
}
