import { PokemonTypeColorsDictionary } from "@/types/dictionarys/PokemonTypeColorsDictionary";
import { TypeEnum } from "@/types/enums/backend/pokemon/TypeEnum";

interface Props {
    pokemonType: TypeEnum;
    className?: string;
}


export default function PokemonType({ pokemonType, className }: Props) {

    const typeColor = PokemonTypeColorsDictionary[pokemonType];

    return (
        <div
            style={{ backgroundColor: typeColor }}
            className={`${className} bg-[] rounded-md w-fit px-2 text-white font-medium`}
        >
            {pokemonType.toUpperCase()}
        </div>
    );
}
