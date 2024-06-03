import { Filters } from '@/types/interfaces/backend/filters/PokemonFilters';
import { useState } from 'react';

interface Props {
    filters: Filters;
    setFilters: Function;
    getAllPokemonWithFilters: Function;
}

export function SearchInput({ filters, setFilters, getAllPokemonWithFilters }: Props) {
    const [searchTerm, setSearchTerm] = useState('');

    const handleInputChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        setSearchTerm(e.target.value);
        setFilters({ ...filters, nameLike: e.target.value });
    };

    const handleSearch = () => {
        getAllPokemonWithFilters();
    };

    const handleKeyDown = (e: React.KeyboardEvent<HTMLInputElement>) => {
        if (e.key === 'Enter') {
            handleSearch();
        }
    };

    return (
        <div className="flex items-center rounded">
            <input
                type="text"
                value={searchTerm}
                onChange={handleInputChange}
                onKeyDown={handleKeyDown}
                placeholder="Search..."
                className="flex-grow p-1 rounded border focus:outline-none focus:ring-2 text-black"
                autoComplete='off'
            />
            <button
                onClick={handleSearch}
                className="ml-2 p-2 bg-[var(--orange-strong)] text-white rounded hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500"
            >
                <svg xmlns="http://www.w3.org/2000/svg" className="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fillRule="evenodd" d="M12.9 14.32a8 8 0 111.414-1.414l4.387 4.387a1 1 0 01-1.414 1.414l-4.387-4.387zM14 8a6 6 0 11-12 0 6 6 0 0112 0z" clipRule="evenodd" />
                </svg>
            </button>
        </div>
    );
}