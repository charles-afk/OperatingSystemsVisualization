import sys
import random

method = sys.argv[1]

input = open("input.txt", "r") # open input file
lines = input.readlines() # read input file lines
input.close()
temp = []
index = 0

# remove newlines
for line in lines:
    new_line = line.replace("\n", "")
    temp.append(new_line)
    index += 1

index = 0
n_blocks = int(lines[index]) # get number of blocks
index += 1
lines = temp
blocks = lines[index].split(',') # get blocks
temp = []

for block in blocks:
    temp.append(int(block))

blocks = temp
index += 1
n_files = int(lines[index]) # get number of files
files = []
index += 1

# get files
for x in range(n_files):
    file = lines[index].split(',')
    temp = []
    file[0] = int(file[0])
    file[1] = file[1].strip()
    file[2] = int(file[2])
    files.append(file)
    index += 1

# blocks for linked list allocation
linked_blocks = []


def generate_output():
    output_str = str(n_blocks) + "\n"
    if method == "contiguous":
        for block in blocks:
            output_str += str(block) + ", " 
        output_str = output_str[:len(output_str) - 2] + "\n" + str(n_files) + "\n"
        for file in files:
            output_str += str(file[0]) + ", " + file[1] + ", " + str(file[2]) + "\n"
    elif method == "linked_list":
        for block in linked_blocks:
            output_str += str(block) + ", " 
        output_str = output_str[:len(output_str) - 2] + "\n" + str(n_files) + "\n"
        for file in files:
            output_str += str(file[0]) + ", " + file[1] + ", " + str(file[3]) + ", " + str(file[4]) + "\n"
    elif method == "indexed":
        for block in blocks:
            output_str += str(block) + ", " 
        output_str = output_str[:len(output_str) - 2] + "\n" + str(n_files) + "\n"
        for file in files:
            output_str += str(file[0]) + ", " + file[1] + ", " + str(file[2]) + "\n"
    output = open("output.txt", "w")
    output.write(output_str)
    output.close()


def allocate_contiguous():
    for file in files: # loop through files
        finished = False
        index = 0
        while not finished:
            if index >= n_blocks: # check if index has exceeded limit
                finished == True
            else:
                if blocks[index] == 0: # check if block is free
                    pointer = index
                    is_space = True
                    is_end = False
                    for x in range(file[2]): # check if there are enough free blocks for the file
                        if pointer >= n_blocks:
                            is_end = True
                            finished = True
                            break
                        if blocks[pointer] != 0:
                            is_space = False
                            index = pointer + 1
                            break
                        pointer += 1
                    if is_end:
                        break
                    if is_space:
                        while index < pointer:  # allocate
                            blocks[index] = file[0]
                            index += 1
                        finished = True
                else:
                    index += 1
    generate_output()


def allocate_linked_list():
    for block in blocks:
        linked_blocks.append([block, -1])   # linked block contains file id and link
    
    free_blocks = []
    for x in range(32):     # keep track of free blocks
        free_blocks.append(x)
    
    file_index = 0
    for file in files:
        if len(free_blocks) == 0:   # check if there are still free blocks
            break
        start = random.choice(free_blocks)  # start at a random free block
        free_blocks.remove(start)   # remove this block's index so it isn't selected again
        pointer = start
        for x in range(file[2]):
            if len(free_blocks) == 0:
                break
            previous = pointer  # keep track of the previous block
            pointer = random.choice(free_blocks)
            linked_blocks[pointer] = [file[0], -1]  # assign file and null link to block 
            linked_blocks[previous][1] = pointer  # make this block's index the previous block's link
            free_blocks.remove(pointer)
        end = pointer
        file.append(start)  # store start and end blocks
        file.append(end)
    generate_output()


def allocate_indexed():
    free_blocks = []
    for x in range(32):
        free_blocks.append(x)

    for file in files:
        if len(free_blocks) == 0:
            break
        indexed_block = [file[0], []]       # create the index block with the file id and list of blocks
        ib_index = random.choice(free_blocks) # assign a random block as the index block
        free_blocks.remove(ib_index)
        pointer = random.choice(free_blocks) 
        free_blocks.remove(pointer)
        for x in range(file[2]):
            if len(free_blocks) == 0:
                break
            pointer = random.choice(free_blocks) # assign a random block and store in index block
            free_blocks.remove(pointer)
            blocks[pointer] = file[0]
            indexed_block[1].append(pointer)
        blocks[ib_index] = indexed_block 
    generate_output()


if method == "contiguous":
    allocate_contiguous()
elif method == "linked_list":
    allocate_linked_list()
elif method == "indexed":
    allocate_indexed()
