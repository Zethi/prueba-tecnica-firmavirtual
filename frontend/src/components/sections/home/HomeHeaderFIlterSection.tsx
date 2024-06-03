import { FiltersDropdown } from "@/components/ui/Filters/FiltersDropDown";
import { SearchInput } from "@/components/ui/TextInput/SearchInput";
import { useDependency } from "@/hooks/useDependency";
import { TypeEnum } from "@/types/enums/backend/pokemon/TypeEnum";
import { Filters } from "@/types/interfaces/backend/filters/PokemonFilters";
import { Pokemon } from "@/types/interfaces/backend/pokemon/Pokemon";
import { IPokemonService } from "@/types/interfaces/services/IPokemonServices";
import { useState } from "react";

interface Props {
    pokemons: Pokemon[]
    setPokemonList: Function;
    setSelectedPokemon: Function;
}

export default function HomeHeaderFilterSection({ pokemons, setPokemonList, setSelectedPokemon }: Props) {

    const [filters, setFilters] = useState<Filters>({ limit: 1307, type: Object.values(TypeEnum), sortStat: [], fields: [] });
    const pokemonService = useDependency<IPokemonService>('IPokemonService');

    function getAllPokemonsByFilter(optionalFilters?: Filters) {
        setPokemonList();
        pokemonService.getAll(optionalFilters ?? filters).then((pokemons: Pokemon[]) => {
            setPokemonList(pokemons);
            setSelectedPokemon();
            setPokemonList([{ id: 0, game_id: 0, name: 'Not Found', types: [] }])
        });
    }


    return (

        <>
            <div className="grid grid-cols-2 items-center  gap-0">
                <div className="flex justify-center">
                    <FiltersDropdown setFilters={setFilters} getAllPokemonWithFilters={getAllPokemonsByFilter} filters={filters} />
                </div>

                <div className="">
                    <SearchInput filters={filters ?? {}} getAllPokemonWithFilters={getAllPokemonsByFilter} setFilters={setFilters} />
                </div>
            </div>
        </>


    );
}
