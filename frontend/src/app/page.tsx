'use client';

import HomeHeaderSection from "@/components/sections/home/HomeHeaderSection";
import HomePokemonListSection from "@/components/sections/home/HomePokemonListSection";
import { useDependency } from "@/hooks/useDependency";
import { Pokemon } from "@/types/interfaces/backend/pokemon/Pokemon";
import { IPokemonService } from "@/types/interfaces/services/IPokemonServices";
import { addLeadingZeros } from "@/utils/StringUtils";
import Image from "next/image";
import { useEffect, useState } from "react";

export default function Home() {


  const pokemonService = useDependency<IPokemonService>('IPokemonService');
  const [pokemons, setPokemons] = useState<Pokemon[]>();
  const [pokemonSelected, setPokemonSelected] = useState<Pokemon>();

  useEffect(() => {
    pokemonService.getAll({ limit: 1307 }).then((pokemons: Pokemon[]) => {
      setPokemons(pokemons);
    })
  }, [pokemonService])


  return (
    <main className="h-full">

      <HomeHeaderSection pokemons={pokemons ?? []} setPokemonList={setPokemons} setSelectedPokemon={setPokemonSelected} />

      <div className="grid grid-cols-2 h-full">
        <div className="hidden lg:flex flex-col py-16 items-center">

          {
            pokemonSelected ?
              <Image alt="pokemon-image" src={`https://raw.githubusercontent.com/HybridShivam/Pokemon/master/assets/images/${addLeadingZeros(pokemonSelected.game_id)}.png`} width={600} height={600} />
              :
              <></>
          }
        </div>

        <div className="col-span-2 lg:col-span-1 flex justify-center py-12">
          <HomePokemonListSection pokemons={pokemons ?? []} selectedPokemon={pokemonSelected} setPokemonSelected={setPokemonSelected} />
        </div>

      </div>
    </main>
  );
}
