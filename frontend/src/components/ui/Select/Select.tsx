import { useState, useRef, useEffect } from 'react';

interface SelectProps {
    options: { value: string; label: string }[];
    onChange: (value: string) => void;
    defaultValue: string;
}

export function Select({ options, onChange, defaultValue }: SelectProps) {
    const initialSelectedOption = options.find(option => option.value === defaultValue) ? defaultValue : options[0].value;

    const [isOpen, setIsOpen] = useState(false);
    const [selectedOption, setSelectedOption] = useState<string>(initialSelectedOption);
    const selectRef = useRef<HTMLDivElement>(null);

    function handleOptionClick(value: string) {
        setSelectedOption(value);
        setIsOpen(false);
        onChange(value);
    }

    function handleClickOutside(event: MouseEvent) {
        if (selectRef.current && !selectRef.current.contains(event.target as Node)) {
            setIsOpen(false);
        }
    }

    useEffect(() => {
        document.addEventListener("mousedown", handleClickOutside);
        return () => {
            document.removeEventListener("mousedown", handleClickOutside);
        };
    }, []);

    return (
        <div className="relative w-full" ref={selectRef}>
            <div
                className="block appearance-none w-full bg-transparent font-medium px-1 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline cursor-pointer"
                onClick={() => setIsOpen(!isOpen)}
            >
                {options.find(option => option.value === selectedOption)?.label}
                <div className="pointer-events-none absolute inset-y-0 right-0 flex items-center text-white">
                    <svg className="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M5.293 7.293L9.293 11.293 13.293 7.293 14.707 8.707 9.293 14.121 3.879 8.707z" />
                    </svg>
                </div>
            </div>
            {isOpen && (
                <ul className="absolute text-black z-10 mt-1 text-sm w-48 -right-8 bg-white border border-gray-400 rounded shadow-lg max-h-60 overflow-auto">
                    {options.map((option) => (
                        <li
                            key={option.value}
                            onClick={() => handleOptionClick(option.value)}
                            className="px-4 py-2 hover:bg-gray-200 cursor-pointer "
                        >
                            {option.label}
                        </li>
                    ))}
                </ul>
            )}
        </div>
    );
}