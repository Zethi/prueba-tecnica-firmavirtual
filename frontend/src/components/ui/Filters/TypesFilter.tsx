import { TypeEnum } from "@/types/enums/backend/pokemon/TypeEnum";
import { Filters } from "@/types/interfaces/backend/filters/PokemonFilters";

interface Props {
    filters: Filters;
    setFilters: Function;
    getAllPokemonWithFilters: Function;
    children: React.ReactNode;
    type: TypeEnum;
}
export function TypesFilter({ children, setFilters, filters, type, getAllPokemonWithFilters }: Props) {

    const isActive = filters.type!.includes(type);

    const handleCheckboxChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        let newFilters = { ...filters };

        if (!e.target.checked) {
            newFilters.type = newFilters.type!.filter((filterType: TypeEnum) => filterType !== type)
        } else {
            newFilters.type = [...filters.type!, type];
        };


        setFilters({ ...newFilters })
        getAllPokemonWithFilters();
    };

    return (
        <label className="flex items-center space-x-2">
            <input
                type="checkbox"
                checked={isActive}
                onChange={handleCheckboxChange}
                className="form-checkbox h-4 w-4 text-blue-600"
            />
            <span className="">{children}</span>
        </label>
    )
}